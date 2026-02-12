<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
        
        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'attendance_radius', 'value' => '100', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'office_latitude', 'value' => '-6.200000', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'office_longitude', 'value' => '106.816666', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'office_address', 'value' => 'Jakarta Pusat', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'morning_start', 'value' => '07:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'morning_end', 'value' => '08:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'night_start', 'value' => '19:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'night_end', 'value' => '20:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'checkout_start', 'value' => '16:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'checkout_end', 'value' => '17:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
