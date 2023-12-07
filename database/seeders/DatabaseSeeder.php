<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'opd_id'    => 1,
            'name' => 'Admin',
            'email' => 'devkh@gmail.com',
            'password'  => bcrypt('devkh123'),
            'level' => 'admin'
        ]);

        $opd = [
            ['nama_opd' => 'DPMPTSP'],
            ['nama_opd' => 'CAPIL'],
            ['nama_opd' => 'POLRES'],
            ['nama_opd' => 'KEJARI'],
            ['nama_opd' => 'KEMENAG'],
            ['nama_opd' => 'KP2KP'],
            ['nama_opd' => 'BPOM'],
            ['nama_opd' => 'BPJS TK'],
            ['nama_opd' => 'BPJS KES'],
            ['nama_opd' => 'IMIGRASI'],
            ['nama_opd' => 'PENGADILAN AGAMA'],
            ['nama_opd' => 'BANK LAMPUNG'],
            ['nama_opd' => 'BANK MANDIRI'],
            ['nama_opd' => 'TASPEN'],
        ];

        foreach ($opd as  $o) {
            \App\Models\Opd::create($o);
        }
    }
}
