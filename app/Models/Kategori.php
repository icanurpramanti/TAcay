<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded=[];

    public static function generateKode()
    {
        $latestKategori = static::orderBy('id', 'desc')->first();

        if ($latestKategori) {
            $lastCode = $latestKategori->kode_kategori;
            $lastNumber = (int)substr($lastCode, 2);
            $newNumber = $lastNumber + 1;
            $newCode = 'K-' . sprintf("%03s", $newNumber);
        } else {
            $newCode = 'K-001';
        }

        return $newCode;
    }
}
