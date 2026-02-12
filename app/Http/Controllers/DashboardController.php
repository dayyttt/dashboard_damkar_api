<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Member;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total statistik
        $totalMembers = Member::where('is_active', true)->count();
        $totalSectors = Sector::where('is_active', true)->count();
        
        // Absensi hari ini
        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('attendance_date', $today)->count();
        $todayPresent = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'Hadir')
            ->count();
        
        // Persentase kehadiran hari ini
        $attendancePercentage = $totalMembers > 0 
            ? round(($todayPresent / $totalMembers) * 100, 1) 
            : 0;
        
        // Data per sektor dengan statistik
        $sectors = Sector::where('is_active', true)
            ->withCount(['members as total_members' => function($query) {
                $query->where('is_active', true);
            }])
            ->with(['members' => function($query) use ($today) {
                $query->where('is_active', true)
                    ->with(['attendances' => function($q) use ($today) {
                        $q->whereDate('attendance_date', $today);
                    }]);
            }])
            ->get()
            ->map(function($sector) use ($today) {
                $totalMembers = $sector->members->count();
                $presentToday = $sector->members->filter(function($member) use ($today) {
                    return $member->attendances->where('attendance_date', $today->format('Y-m-d'))
                        ->where('status', 'Hadir')
                        ->count() > 0;
                })->count();
                
                $sector->present_today = $presentToday;
                $sector->percentage = $totalMembers > 0 
                    ? round(($presentToday / $totalMembers) * 100, 1) 
                    : 0;
                
                return $sector;
            });
        
        // Recent attendances (10 terakhir)
        $recentAttendances = Attendance::with(['member.sector'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Statistik per regu
        $reguStats = [];
        foreach(['A', 'B', 'C'] as $regu) {
            $reguMembers = Member::where('regu', $regu)
                ->where('is_active', true)
                ->count();
            $reguPresent = Attendance::whereDate('attendance_date', $today)
                ->where('status', 'Hadir')
                ->whereHas('member', function($q) use ($regu) {
                    $q->where('regu', $regu);
                })
                ->distinct('member_id')
                ->count('member_id');
            
            $reguStats[$regu] = [
                'total' => $reguMembers,
                'present' => $reguPresent,
                'percentage' => $reguMembers > 0 ? round(($reguPresent / $reguMembers) * 100, 1) : 0
            ];
        }
        
        return view('dashboard', compact(
            'totalMembers',
            'totalSectors',
            'todayAttendances',
            'attendancePercentage',
            'sectors',
            'recentAttendances',
            'reguStats'
        ));
    }
}
