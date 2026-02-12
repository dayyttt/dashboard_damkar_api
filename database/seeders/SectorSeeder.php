<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            [
                'name' => 'Sektor Pusat',
                'location' => 'Jakarta Pusat',
                'code' => 'PUSAT',
                'icon' => 'local_fire_department',
                'address' => 'Jl. Medan Merdeka Selatan, Jakarta Pusat',
                'phone' => '021-3841234',
            ],
            [
                'name' => 'Sektor Utara',
                'location' => 'Tanjung Priok',
                'code' => 'UTARA',
                'icon' => 'apartment',
                'address' => 'Jl. Tanjung Priok, Jakarta Utara',
                'phone' => '021-4351234',
            ],
            [
                'name' => 'Sektor Selatan',
                'location' => 'Kebayoran',
                'code' => 'SELATAN',
                'icon' => 'location_on',
                'address' => 'Jl. Kebayoran Lama, Jakarta Selatan',
                'phone' => '021-7251234',
            ],
            [
                'name' => 'Sektor Barat',
                'location' => 'Cengkareng',
                'code' => 'BARAT',
                'icon' => 'explore',
                'address' => 'Jl. Daan Mogot, Cengkareng, Jakarta Barat',
                'phone' => '021-5451234',
            ],
            [
                'name' => 'Sektor Timur',
                'location' => 'Jatinegara',
                'code' => 'TIMUR',
                'icon' => 'near_me',
                'address' => 'Jl. Jatinegara Barat, Jakarta Timur',
                'phone' => '021-8191234',
            ],
            [
                'name' => 'Sektor Kepulauan',
                'location' => 'Kepulauan Seribu',
                'code' => 'KEPULAUAN',
                'icon' => 'sailing',
                'address' => 'Pulau Pramuka, Kepulauan Seribu',
                'phone' => '021-6801234',
            ],
            [
                'name' => 'Sektor Bandara',
                'location' => 'Soekarno-Hatta',
                'code' => 'BANDARA',
                'icon' => 'flight',
                'address' => 'Bandara Soekarno-Hatta, Tangerang',
                'phone' => '021-5501234',
            ],
        ];

        foreach ($sectors as $sector) {
            \App\Models\Sector::create($sector);
        }
    }
}
