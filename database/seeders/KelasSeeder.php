<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
            ['kelas_name' => 'TI 2A',],
            ['kelas_name' => 'TI 2B',],
            ['kelas_name' => 'TI 2C',],
            ['kelas_name' => 'TI 2D',],
            ['kelas_name' => 'TI 2E',],
            ['kelas_name' => 'TI 2F',],
            ['kelas_name' => 'TI 2G',],
            ['kelas_name' => 'TI 2H',],
            ['kelas_name' => 'TI 2I',],
        ];
        DB::table('kelas')->insert($kelas);
    }
}
