<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop existing constraint first
        DB::statement("ALTER TABLE attendances DROP CONSTRAINT IF EXISTS attendances_status_check");
        
        // For PostgreSQL, we need to alter the type differently
        DB::statement("ALTER TABLE attendances ALTER COLUMN status TYPE VARCHAR(20)");
        DB::statement("ALTER TABLE attendances ALTER COLUMN status SET DEFAULT 'Hadir'");
        
        // Add check constraint for valid values
        DB::statement("ALTER TABLE attendances ADD CONSTRAINT attendances_status_check CHECK (status IN ('Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpha', 'Cepat Pulang', 'Tanpa Keterangan'))");
    }

    public function down(): void
    {
        // Remove check constraint
        DB::statement("ALTER TABLE attendances DROP CONSTRAINT IF EXISTS attendances_status_check");
        
        // Revert to original constraint
        DB::statement("ALTER TABLE attendances ADD CONSTRAINT attendances_status_check CHECK (status IN ('Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpha'))");
    }
};
