<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->truncate();
        DB::table('branches')->insert([
            [
                'nama' => 'Cabang Cianjur',
                'lokasi_cabang' => 'Cianjur',
            ],
            [
                'nama' => 'Cabang Jakarta',
                'lokasi_cabang' => 'Jakarta',
            ],
            [
                'nama' => 'Cabang Sukabumi',
                'lokasi_cabang' => 'Sukabumi',
            ],
            [
                'nama' => 'Cabang Surabaya',
                'lokasi_cabang' => 'Surabaya',
            ],
            [
                'nama' => 'Cabang Bandung',
                'lokasi_cabang' => 'Bandung',
            ],
       
        ]);
    }
}
