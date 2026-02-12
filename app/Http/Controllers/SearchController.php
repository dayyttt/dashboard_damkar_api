<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sector;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->back();
        }
        
        // Search members
        $members = Member::with('sector')
            ->where(function($q) use ($query) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                  ->orWhere('nip', 'like', '%' . $query . '%')
                  ->orWhereRaw('LOWER(jabatan) LIKE ?', ['%' . strtolower($query) . '%']);
            })
            ->limit(10)
            ->get();
        
        // Search sectors
        $sectors = Sector::where(function($q) use ($query) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                  ->orWhereRaw('LOWER(location) LIKE ?', ['%' . strtolower($query) . '%'])
                  ->orWhere('code', 'like', '%' . $query . '%');
            })
            ->limit(5)
            ->get();
        
        return view('search.index', compact('query', 'members', 'sectors'));
    }
    
    public function api(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'members' => [],
                'sectors' => []
            ]);
        }
        
        try {
            // Search members - using whereRaw for case-insensitive search
            $members = Member::with('sector')
                ->where(function($q) use ($query) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                      ->orWhere('nip', 'like', '%' . $query . '%')
                      ->orWhereRaw('LOWER(jabatan) LIKE ?', ['%' . strtolower($query) . '%']);
                })
                ->limit(5)
                ->get()
                ->map(function($member) {
                    return [
                        'id' => $member->id,
                        'name' => $member->name,
                        'nip' => $member->nip,
                        'jabatan' => $member->jabatan,
                        'regu' => $member->regu,
                        'sector_name' => $member->sector->name
                    ];
                });
            
            // Search sectors
            $sectors = Sector::where(function($q) use ($query) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                      ->orWhereRaw('LOWER(location) LIKE ?', ['%' . strtolower($query) . '%'])
                      ->orWhere('code', 'like', '%' . $query . '%');
                })
                ->limit(3)
                ->get()
                ->map(function($sector) {
                    return [
                        'id' => $sector->id,
                        'name' => $sector->name,
                        'location' => $sector->location,
                        'code' => $sector->code,
                        'icon' => $sector->icon
                    ];
                });
            
            return response()->json([
                'members' => $members,
                'sectors' => $sectors
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'members' => [],
                'sectors' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
