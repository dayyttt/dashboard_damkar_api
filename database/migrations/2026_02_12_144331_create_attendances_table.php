<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('sector_id')->constrained()->onDelete('cascade');
            $table->date('attendance_date');
            $table->enum('session', ['Pagi', 'Malam', 'Pulang']); // 3x absen per hari
            $table->time('check_in_time');
            $table->enum('status', ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpha'])->default('Hadir');
            $table->string('photo_path')->nullable(); // Foto selfie saat absen
            $table->decimal('latitude', 10, 8)->nullable(); // GPS location
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('location_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['member_id', 'attendance_date']);
            $table->index(['sector_id', 'attendance_date']);
            $table->index('attendance_date');
            
            // Unique constraint: satu member hanya bisa absen sekali per session per hari
            $table->unique(['member_id', 'attendance_date', 'session']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
