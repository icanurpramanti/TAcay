<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = time() . '.jpg';
        $gambar_profil = 'produk_image/' . $filename;

        // Simpan gambar ke direktori penyimpanan yang sesuai (local atau cloud)
        Storage::put($gambar_profil, file_get_contents(public_path('produk_image/foto_user.jpg')));

        // Menggunakan insert() untuk memasukkan data ke dalam tabel 'users'
        DB::table('users')->insert([
            'nama' => 'Ica Nur Pramanti',
            'level' => 'admin',
            'foto_user' => $filename,
            'email' => 'ica@gmail.com',
            'password' => Hash::make('password'),
            'alamat_user' => 'gurun laweh',
            'no_hp' => '085355439355',
        ]);
    }
}
