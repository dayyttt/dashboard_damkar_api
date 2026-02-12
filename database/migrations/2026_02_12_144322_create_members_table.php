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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained()->onDelete('cascade');
            $table->string('nip', 18)->unique(); // Nomor Induk Pegawai (18 digit)
            $table->string('name');
            $table->enum('regu', ['A', 'B', 'C']); // Regu A, B, atau C
            $table->enum('jabatan', ['Anggota', 'Komandan Regu', 'Kepala Sektor'])->default('Anggota');
            $table->string('email')->unique()->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('join_date')->nullable();
            $table->string('password'); // Untuk login mobile app
            $table->string('photo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Index untuk performa
            $table->index(['sector_id', 'regu']);
            $table->index('nip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
