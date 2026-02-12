<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user
        \App\Models\User::create([
            'name' => 'Admin Damkar',
            'email' => 'admin@damkar.jakarta.go.id',
            'password' => bcrypt('admin123'),
        ]);
        
        // Seed sectors dan members
        $this->call([
            SectorSeeder::class,
            MemberSeeder::class,
        ]);
    }
}
