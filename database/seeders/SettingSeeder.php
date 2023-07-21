<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'nama_toko' => 'SRC Rani Cell',
            'alamat' => 'Jl. Gurun Laweh',
            'telepon' => '081363437701',
            'tipe_nota' => 1, // kecil
            'diskon' => 5,
            
           
        ]);
    }
}
