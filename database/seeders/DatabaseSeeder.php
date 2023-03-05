<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
    // }

    public function run()
    {
        \App\Models\petugas::create([
            'nama_petugas' => 'Adminstrator',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'telp' => '08990671253',
            'level' => 'admin',
        ]);
        \App\Models\petugas::create([
            'nama_petugas' => 'keiel',
            'username' => 'keisha ananta toer',
            'password' => Hash::make('keishapacardaffa'),
            'telp' => '08990671253',
            'level' => 'petugas',
        ]);
        \App\Models\masyarakat::create([
            'nik' => '2303265464',
            'nama' => 'keisha',
            'email' => 'kei@gmail.com',
            'username' => 'username',
            'password' => Hash::make('keisha')
        ]);
    }

    public function petugas()
    {
        
    }

    public function user()
    {
        
    }
}
