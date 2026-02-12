<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sector;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('sector');
        
        // Filter by sector
        if ($request->sector_id) {
            $query->where('sector_id', $request->sector_id);
        }
        
        // Filter by regu
        if ($request->regu) {
            $query->where('regu', $request->regu);
        }
        
        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('nrp', 'like', '%' . $request->search . '%');
            });
        }
        
        $members = $query->orderBy('name')->paginate(20);
        $sectors = Sector::where('is_active', true)->get();
        
        return view('members.index', compact('members', 'sectors'));
    }

    public function create()
    {
        $sectors = Sector::where('is_active', true)->get();
        return view('members.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:18|unique:members,nip',
            'nrp' => 'required|string|max:50|unique:members,nrp',
            'sector_id' => 'required|exists:sectors,id',
            'regu' => 'required|in:A,B,C',
            'jabatan' => 'required|string|max:100',
            'pangkat' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:5',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show(Member $member)
    {
        $member->load('sector', 'attendances');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $sectors = Sector::where('is_active', true)->get();
        return view('members.edit', compact('member', 'sectors'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|size:18|unique:members,nip,' . $member->id,
            'nrp' => 'required|string|max:50|unique:members,nrp,' . $member->id,
            'sector_id' => 'required|exists:sectors,id',
            'regu' => 'required|in:A,B,C',
            'jabatan' => 'required|string|max:100',
            'pangkat' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:5',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus');
    }
}
