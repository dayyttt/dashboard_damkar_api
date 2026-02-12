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
        Schema::create('fake_gps_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->string('device_info')->nullable(); // Info device
            $table->string('app_version')->nullable(); // Versi app
            $table->timestamp('detected_at'); // Waktu terdeteksi
            $table->boolean('is_read')->default(false); // Sudah dibaca admin atau belum
            $table->timestamps();
            
            $table->index(['member_id', 'detected_at']);
            $table->index('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fake_gps_logs');
    }
};
