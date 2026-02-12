<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FakeGpsLog;
use Carbon\Carbon;

class FakeGpsLogController extends Controller
{
    public function index(Request $request)
    {
        $query = FakeGpsLog::with('member.sector')
            ->orderBy('detected_at', 'desc');
        
        // Filter by date range
        if ($request->start_date) {
            $query->whereDate('detected_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('detected_at', '<=', $request->end_date);
        }
        
        // Filter by read status
        if ($request->has('is_read')) {
            $query->where('is_read', $request->is_read);
        }
        
        $logs = $query->paginate(20);
        
        // Count unread
        $unreadCount = FakeGpsLog::where('is_read', false)->count();
        
        return view('fake-gps-logs.index', compact('logs', 'unreadCount'));
    }
    
    public function markAsRead($id)
    {
        $log = FakeGpsLog::findOrFail($id);
        $log->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Log ditandai sudah dibaca');
    }
    
    public function markAllAsRead()
    {
        FakeGpsLog::where('is_read', false)->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Semua log ditandai sudah dibaca');
    }
    
    public function destroy($id)
    {
        $log = FakeGpsLog::findOrFail($id);
        $log->delete();
        
        return redirect()->back()->with('success', 'Log berhasil dihapus');
    }
}
