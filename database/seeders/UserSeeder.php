<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Ica Nur Pramanti',
            'level' => 'admin',
            'foto_user'=>'1686802877.jpg',
            'email'=>'ica@gmail.com',
            'password'=>'123',
            'alamat_user'=>'gurun laweh',
            'no_hp'=>'085355439355',
           
        ]);
    }
}
