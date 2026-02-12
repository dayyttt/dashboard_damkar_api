<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'session' => 'required|in:Pagi,Malam,Pulang',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image|max:2048',
            'status' => 'required|in:Hadir,Izin,Sakit',
            'notes' => 'nullable|string',
        ]);

        $member = $request->user();
        $today = Carbon::today('Asia/Jakarta');
        $now = Carbon::now('Asia/Jakarta');

        // Get settings
        $settings = \DB::table('settings')->pluck('value', 'key');
        $officeLatitude = (float) ($settings['office_latitude'] ?? -6.200000);
        $officeLongitude = (float) ($settings['office_longitude'] ?? 106.816666);
        $allowedRadius = (int) ($settings['attendance_radius'] ?? 100);

        // Validate location (geofencing) - only for status "Hadir"
        if ($request->status === 'Hadir') {
            $distance = $this->calculateDistance(
                $officeLatitude,
                $officeLongitude,
                $request->latitude,
                $request->longitude
            );

            if ($distance > $allowedRadius) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda berada di luar area absen. Jarak Anda: ' . round($distance) . ' meter (maksimal: ' . $allowedRadius . ' meter)',
                    'data' => [
                        'distance' => round($distance),
                        'max_distance' => $allowedRadius,
                        'office_location' => [
                            'latitude' => $officeLatitude,
                            'longitude' => $officeLongitude,
                        ]
                    ]
                ], 422);
            }
        }

        // Validate time schedule
        // Check time schedule with 10 minutes tolerance before start time
        $currentTime = $now->format('H:i');
        $sessionKey = strtolower($request->session);
        $startTime = $settings[$sessionKey . '_start'] ?? '00:00';
        $endTime = $settings[$sessionKey . '_end'] ?? '23:59';

        // Add 10 minutes tolerance before start time
        $startTimeWithTolerance = Carbon::createFromFormat('H:i', $startTime, 'Asia/Jakarta')
            ->subMinutes(10)
            ->format('H:i');

        if ($currentTime < $startTimeWithTolerance || $currentTime > $endTime) {
            return response()->json([
                'success' => false,
                'message' => 'Waktu absen ' . $request->session . ' adalah ' . $startTime . ' - ' . $endTime . ' (dapat absen 10 menit sebelumnya). Sekarang: ' . $currentTime,
                'data' => [
                    'current_time' => $currentTime,
                    'allowed_start' => $startTime,
                    'allowed_start_with_tolerance' => $startTimeWithTolerance,
                    'allowed_end' => $endTime,
                ]
            ], 422);
        }

        // Check if already checked in for this session today
        $existing = Attendance::where('member_id', $member->id)
            ->where('attendance_date', $today)
            ->where('session', $request->session)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah absen untuk sesi ' . $request->session . ' hari ini'
            ], 422);
        }

        // Upload photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('attendance-photos', 'public');
        }

        // Create attendance
        $attendance = Attendance::create([
            'member_id' => $member->id,
            'sector_id' => $member->sector_id,
            'attendance_date' => $today,
            'session' => $request->session,
            'check_in_time' => $now->format('H:i:s'),
            'status' => $request->status,
            'photo_path' => $photoPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_address' => $request->location_address,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil disimpan',
            'data' => [
                'id' => $attendance->id,
                'date' => $attendance->attendance_date,
                'session' => $attendance->session,
                'time' => $attendance->check_in_time,
                'status' => $attendance->status,
            ]
        ]);
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     * Returns distance in meters
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Earth radius in meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance; // in meters
    }

    public function history(Request $request)
    {
        $member = $request->user();
        
        $attendances = Attendance::where('member_id', $member->id)
            ->orderBy('attendance_date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->limit(50)
            ->get()
            ->map(function($attendance) {
                return [
                    'id' => $attendance->id,
                    'date' => $attendance->attendance_date,
                    'session' => $attendance->session,
                    'check_in_time' => $attendance->check_in_time,
                    'status' => $attendance->status,
                    'photo' => $attendance->photo_path ? url('storage/' . $attendance->photo_path) : null,
                    'location' => $attendance->location_address,
                    'notes' => $attendance->notes,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $attendances
        ]);
    }

    public function today(Request $request)
    {
        $member = $request->user();
        $today = Carbon::today('Asia/Jakarta');

        $attendances = Attendance::where('member_id', $member->id)
            ->where('attendance_date', $today)
            ->get()
            ->map(function($attendance) {
                return [
                    'session' => $attendance->session,
                    'time' => $attendance->check_in_time,
                    'status' => $attendance->status,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'date' => $today->format('Y-m-d'),
                'attendances' => $attendances,
                'completed_sessions' => $attendances->pluck('session')->toArray(),
            ]
        ]);
    }

    public function checkValidation(Request $request)
    {
        $request->validate([
            'session' => 'required|in:Pagi,Malam,Pulang',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $member = $request->user();
        $now = Carbon::now('Asia/Jakarta');
        $today = Carbon::today('Asia/Jakarta');

        // Get settings
        $settings = \DB::table('settings')->pluck('value', 'key');
        $officeLatitude = (float) ($settings['office_latitude'] ?? -6.200000);
        $officeLongitude = (float) ($settings['office_longitude'] ?? 106.816666);
        $allowedRadius = (int) ($settings['attendance_radius'] ?? 100);

        // Calculate distance
        $distance = $this->calculateDistance(
            $officeLatitude,
            $officeLongitude,
            $request->latitude,
            $request->longitude
        );

        $isLocationValid = $distance <= $allowedRadius;

        // Check time schedule with 10 minutes tolerance before start time
        $currentTime = $now->format('H:i');
        $sessionKey = strtolower($request->session);
        $startTime = $settings[$sessionKey . '_start'] ?? '00:00';
        $endTime = $settings[$sessionKey . '_end'] ?? '23:59';

        // Add 10 minutes tolerance before start time
        $startTimeWithTolerance = Carbon::createFromFormat('H:i', $startTime, 'Asia/Jakarta')
            ->subMinutes(10)
            ->format('H:i');

        $isTimeValid = $currentTime >= $startTimeWithTolerance && $currentTime <= $endTime;

        // Check if already checked in
        $alreadyCheckedIn = Attendance::where('member_id', $member->id)
            ->where('attendance_date', $today)
            ->where('session', $request->session)
            ->exists();

        $canCheckIn = $isLocationValid && $isTimeValid && !$alreadyCheckedIn;

        return response()->json([
            'success' => true,
            'data' => [
                'can_check_in' => $canCheckIn,
                'location' => [
                    'is_valid' => $isLocationValid,
                    'distance' => round($distance),
                    'max_distance' => $allowedRadius,
                    'message' => $isLocationValid 
                        ? 'Anda berada di area absen' 
                        : 'Anda berada di luar area absen (' . round($distance) . 'm dari kantor)'
                ],
                'time' => [
                    'is_valid' => $isTimeValid,
                    'current' => $currentTime,
                    'start' => $startTime,
                    'end' => $endTime,
                    'message' => $isTimeValid 
                        ? 'Waktu absen masih berlaku' 
                        : 'Waktu absen ' . $request->session . ' adalah ' . $startTime . ' - ' . $endTime
                ],
                'already_checked_in' => $alreadyCheckedIn,
                'message' => $canCheckIn 
                    ? 'Anda dapat melakukan absensi' 
                    : ($alreadyCheckedIn 
                        ? 'Anda sudah absen untuk sesi ini' 
                        : (!$isLocationValid 
                            ? 'Anda berada di luar area absen' 
                            : 'Waktu absen belum/sudah berlalu'))
            ]
        ]);
    }

    public function logFakeGps(Request $request)
    {
        $request->validate([
            'device_info' => 'nullable|string',
            'app_version' => 'nullable|string',
        ]);

        $member = $request->user();

        // Create log
        \App\Models\FakeGpsLog::create([
            'member_id' => $member->id,
            'device_info' => $request->device_info,
            'app_version' => $request->app_version,
            'detected_at' => Carbon::now('Asia/Jakarta'),
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fake GPS detection logged successfully',
        ]);
    }
}
