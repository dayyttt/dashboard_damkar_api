<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        $member = Member::with('sector')->where('nip', $request->nip)->first();

        if (!$member || !Hash::check($request->password, $member->password)) {
            return response()->json([
                'success' => false,
                'message' => 'NIP atau password salah'
            ], 401);
        }

        if (!$member->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif'
            ], 403);
        }

        // Create token
        $token = $member->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $member->id,
                    'nip' => $member->nip,
                    'nama' => $member->name,
                    'email' => $member->email,
                    'phone' => $member->phone,
                    'jabatan' => $member->jabatan,
                    'regu' => $member->regu,
                    'sektor' => $member->sector->name,
                    'sector_id' => $member->sector_id,
                    'photo' => $member->photo_path ? url('storage/' . $member->photo_path) : null,
                ]
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function profile(Request $request)
    {
        $member = $request->user()->load('sector');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $member->id,
                'nip' => $member->nip,
                'nama' => $member->name,
                'email' => $member->email,
                'phone' => $member->phone,
                'jabatan' => $member->jabatan,
                'regu' => $member->regu,
                'sektor' => $member->sector->name,
                'sector_id' => $member->sector_id,
                'photo' => $member->photo_path ? url('storage/' . $member->photo_path) : null,
                'join_date' => $member->join_date,
                'address' => $member->address,
            ]
        ]);
    }
}
