<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->pluck('value', 'key');

        return response()->json([
            'success' => true,
            'data' => [
                'location' => [
                    'latitude' => (float) ($settings['office_latitude'] ?? -6.200000),
                    'longitude' => (float) ($settings['office_longitude'] ?? 106.816666),
                    'address' => $settings['office_address'] ?? 'Jakarta Pusat',
                    'radius' => (int) ($settings['attendance_radius'] ?? 100),
                ],
                'schedule' => [
                    'morning' => [
                        'start' => $settings['morning_start'] ?? '07:00',
                        'end' => $settings['morning_end'] ?? '08:00',
                    ],
                    'night' => [
                        'start' => $settings['night_start'] ?? '19:00',
                        'end' => $settings['night_end'] ?? '20:00',
                    ],
                    'checkout' => [
                        'start' => $settings['checkout_start'] ?? '16:00',
                        'end' => $settings['checkout_end'] ?? '17:00',
                    ],
                ]
            ]
        ]);
    }
}
