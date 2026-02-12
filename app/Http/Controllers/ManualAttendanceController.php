<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Sector;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManualAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['member', 'sector'])
            ->orderBy('attendance_date', 'desc')
            ->orderBy('check_in_time', 'desc');
        
        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('attendance_date', $request->date);
        }
        
        // Filter by sector
        if ($request->filled('sector_id')) {
            $query->where('sector_id', $request->sector_id);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->paginate(20);
        $sectors = Sector::all();
        
        return view('manual-attendance.index', compact('attendances', 'sectors'));
    }
    
    public function create()
    {
        $members = Member::with('sector')->orderBy('name')->get();
        $sectors = Sector::all();
        
        return view('manual-attendance.create', compact('members', 'sectors'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'attendance_date' => 'required|date',
            'session' => 'required|in:Pagi,Malam,Pulang',
            'check_in_time' => 'required|date_format:H:i',
            'status' => 'required|in:Hadir,Terlambat,Izin,Sakit,Alpha,Cepat Pulang,Tanpa Keterangan',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $member = Member::findOrFail($validated['member_id']);
        
        // Check if already exists
        $existing = Attendance::where('member_id', $member->id)
            ->where('attendance_date', $validated['attendance_date'])
            ->where('session', $validated['session'])
            ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Absensi untuk anggota ini pada tanggal dan sesi tersebut sudah ada');
        }
        
        Attendance::create([
            'member_id' => $member->id,
            'sector_id' => $member->sector_id,
            'attendance_date' => $validated['attendance_date'],
            'session' => $validated['session'],
            'check_in_time' => $validated['check_in_time'],
            'status' => $validated['status'],
            'notes' => $validated['notes'],
            'location_address' => 'Input Manual oleh Admin',
        ]);
        
        return redirect()->route('manual-attendance.index')
            ->with('success', 'Absensi berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $attendance = Attendance::with('member')->findOrFail($id);
        $members = Member::with('sector')->orderBy('name')->get();
        
        return view('manual-attendance.edit', compact('attendance', 'members'));
    }
    
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        
        $validated = $request->validate([
            'check_in_time' => 'required|date_format:H:i',
            'status' => 'required|in:Hadir,Terlambat,Izin,Sakit,Alpha,Cepat Pulang,Tanpa Keterangan',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $attendance->update($validated);
        
        return redirect()->route('manual-attendance.index')
            ->with('success', 'Absensi berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        
        return redirect()->route('manual-attendance.index')
            ->with('success', 'Absensi berhasil dihapus');
    }
}
