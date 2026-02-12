<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Sector;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sectors = Sector::all(); // Ambil semua sektor tanpa filter is_active
        
        // Default date range: current month
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        
        $query = Attendance::with(['member.sector'])
            ->whereBetween('attendance_date', [$startDate, $endDate]);
        
        // Filter by sector
        if ($request->sector_id) {
            $query->whereHas('member', function($q) use ($request) {
                $q->where('sector_id', $request->sector_id);
            });
        }
        
        // Filter by regu
        if ($request->regu) {
            $query->whereHas('member', function($q) use ($request) {
                $q->where('regu', $request->regu);
            });
        }
        
        // Filter by session
        if ($request->session) {
            $query->where('session', $request->session);
        }
        
        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->orderBy('attendance_date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->paginate(50);
        
        // Statistics
        $totalAttendances = Attendance::whereBetween('attendance_date', [$startDate, $endDate])->count();
        $totalHadir = Attendance::whereBetween('attendance_date', [$startDate, $endDate])->where('status', 'Hadir')->count();
        $totalIzin = Attendance::whereBetween('attendance_date', [$startDate, $endDate])->where('status', 'Izin')->count();
        $totalSakit = Attendance::whereBetween('attendance_date', [$startDate, $endDate])->where('status', 'Sakit')->count();
        
        return view('reports.index', compact(
            'attendances',
            'sectors',
            'startDate',
            'endDate',
            'totalAttendances',
            'totalHadir',
            'totalIzin',
            'totalSakit'
        ));
    }
    
    public function export(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        
        $query = Attendance::with(['member.sector'])
            ->whereBetween('attendance_date', [$startDate, $endDate]);
        
        if ($request->sector_id) {
            $query->whereHas('member', function($q) use ($request) {
                $q->where('sector_id', $request->sector_id);
            });
        }
        
        if ($request->regu) {
            $query->whereHas('member', function($q) use ($request) {
                $q->where('regu', $request->regu);
            });
        }
        
        if ($request->session) {
            $query->where('session', $request->session);
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->orderBy('attendance_date', 'desc')->get();
        
        $filename = 'laporan_absensi_' . $startDate . '_' . $endDate . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($attendances) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Tanggal',
                'Sesi',
                'Nama',
                'NIP',
                'Pangkat',
                'Jabatan',
                'Sektor',
                'Regu',
                'Status',
                'Jam Masuk',
                'Keterangan'
            ]);
            
            // Data
            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    Carbon::parse($attendance->attendance_date)->format('d/m/Y'),
                    ucfirst($attendance->session),
                    $attendance->member->name,
                    $attendance->member->nip,
                    $attendance->member->pangkat,
                    $attendance->member->jabatan,
                    $attendance->member->sector->name,
                    'Regu ' . $attendance->member->regu,
                    ucfirst($attendance->status),
                    $attendance->check_in_time ?? '-',
                    $attendance->notes ?? '-'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
