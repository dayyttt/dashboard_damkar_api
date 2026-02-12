<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Member;

class ReguController extends Controller
{
    public function index(Request $request)
    {
        $sectors = Sector::where('is_active', true)->get();
        $selectedSector = $request->sector_id ? Sector::find($request->sector_id) : $sectors->first();
        
        if ($selectedSector) {
            $reguData = [];
            foreach(['A', 'B', 'C'] as $regu) {
                $members = Member::where('sector_id', $selectedSector->id)
                    ->where('regu', $regu)
                    ->where('is_active', true)
                    ->get();
                
                $reguData[$regu] = [
                    'members' => $members,
                    'total' => $members->count(),
                    'komandan' => $members->where('jabatan', 'Komandan Regu')->first(),
                ];
            }
        } else {
            $reguData = ['A' => [], 'B' => [], 'C' => []];
        }
        
        return view('regu.index', compact('sectors', 'selectedSector', 'reguData'));
    }
}
