<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua sektor
        $sectors = \App\Models\Sector::all();
        
        $regus = ['A', 'B', 'C'];
        $jabatans = ['Anggota', 'Komandan Regu', 'Kepala Sektor'];
        
        // Buat 1 member demo untuk testing (Budi Santoso dari Flutter app)
        \App\Models\Member::create([
            'sector_id' => 1, // Sektor Pusat
            'nip' => '198501012010011001',
            'name' => 'Budi Santoso',
            'regu' => 'B',
            'jabatan' => 'Anggota',
            'email' => 'budi.santoso@damkar.jakarta.go.id',
            'phone' => '081234567890',
            'address' => 'Jakarta Pusat',
            'join_date' => '2010-01-01',
            'password' => bcrypt('12345'),
            'is_active' => true,
        ]);
        
        // Generate members untuk setiap sektor (36 per sektor, 12 per regu)
        foreach ($sectors as $sector) {
            foreach ($regus as $regu) {
                // 1 Komandan Regu per regu
                \App\Models\Member::create([
                    'sector_id' => $sector->id,
                    'nip' => '19' . str_pad($sector->id, 2, '0', STR_PAD_LEFT) . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '2010' . $regu . '10001',
                    'name' => 'Komandan Regu ' . $regu . ' - ' . $sector->name,
                    'regu' => $regu,
                    'jabatan' => 'Komandan Regu',
                    'email' => strtolower('komandan.' . $regu . '.' . $sector->code . '@damkar.jakarta.go.id'),
                    'phone' => '0812' . rand(10000000, 99999999),
                    'address' => $sector->location,
                    'join_date' => '2010-01-01',
                    'password' => bcrypt('password'),
                    'is_active' => true,
                ]);
                
                // 11 Anggota per regu
                for ($i = 1; $i <= 11; $i++) {
                    \App\Models\Member::create([
                        'sector_id' => $sector->id,
                        'nip' => '19' . str_pad($sector->id, 2, '0', STR_PAD_LEFT) . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '2015' . $regu . str_pad($i, 4, '0', STR_PAD_LEFT),
                        'name' => 'Anggota ' . $i . ' Regu ' . $regu . ' - ' . $sector->name,
                        'regu' => $regu,
                        'jabatan' => 'Anggota',
                        'email' => strtolower('anggota.' . $i . '.' . $regu . '.' . $sector->code . '@damkar.jakarta.go.id'),
                        'phone' => '0812' . rand(10000000, 99999999),
                        'address' => $sector->location,
                        'join_date' => '2015-01-01',
                        'password' => bcrypt('password'),
                        'is_active' => true,
                    ]);
                }
            }
            
            // 1 Kepala Sektor
            \App\Models\Member::create([
                'sector_id' => $sector->id,
                'nip' => '19' . str_pad($sector->id, 2, '0', STR_PAD_LEFT) . '01200500010001',
                'name' => 'Kepala ' . $sector->name,
                'regu' => 'A', // Default regu untuk kepala sektor
                'jabatan' => 'Kepala Sektor',
                'email' => strtolower('kepala.' . $sector->code . '@damkar.jakarta.go.id'),
                'phone' => '0812' . rand(10000000, 99999999),
                'address' => $sector->location,
                'join_date' => '2005-01-01',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]);
        }
    }
}
