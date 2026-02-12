<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        // Get settings from database or config
        $settings = [
            'attendance_radius' => $this->getSetting('attendance_radius', 100),
            'office_latitude' => $this->getSetting('office_latitude', -6.200000),
            'office_longitude' => $this->getSetting('office_longitude', 106.816666),
            'office_address' => $this->getSetting('office_address', 'Jakarta Pusat'),
            'morning_start' => $this->getSetting('morning_start', '07:00'),
            'morning_end' => $this->getSetting('morning_end', '08:00'),
            'night_start' => $this->getSetting('night_start', '19:00'),
            'night_end' => $this->getSetting('night_end', '20:00'),
            'checkout_start' => $this->getSetting('checkout_start', '16:00'),
            'checkout_end' => $this->getSetting('checkout_end', '17:00'),
        ];
        
        return view('settings.index', compact('settings'));
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'attendance_radius' => 'required|numeric|min:10|max:1000',
            'office_latitude' => 'required|numeric|min:-90|max:90',
            'office_longitude' => 'required|numeric|min:-180|max:180',
            'office_address' => 'required|string|max:255',
            'morning_start' => 'required|date_format:H:i',
            'morning_end' => 'required|date_format:H:i',
            'night_start' => 'required|date_format:H:i',
            'night_end' => 'required|date_format:H:i',
            'checkout_start' => 'required|date_format:H:i',
            'checkout_end' => 'required|date_format:H:i',
        ]);
        
        // Round latitude and longitude to 6 decimal places (accurate to ~0.11 meters)
        if (isset($validated['office_latitude'])) {
            $validated['office_latitude'] = round($validated['office_latitude'], 6);
        }
        if (isset($validated['office_longitude'])) {
            $validated['office_longitude'] = round($validated['office_longitude'], 6);
        }
        
        foreach ($validated as $key => $value) {
            $this->setSetting($key, $value);
        }
        
        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan');
    }
    
    private function getSetting($key, $default = null)
    {
        $setting = DB::table('settings')->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    private function setSetting($key, $value)
    {
        DB::table('settings')->updateOrInsert(
            ['key' => $key],
            ['value' => $value, 'updated_at' => now()]
        );
    }
}
