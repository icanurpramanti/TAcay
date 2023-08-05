<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public static function generateKode()
    {
        $latestSatuan = static::orderBy('id', 'desc')->first();

        if ($latestSatuan) {
            $lastCode = $latestSatuan->kode_satuan;
            $lastNumber = (int)substr($lastCode, 2);
            $newNumber = $lastNumber + 1;
            $newCode = 'S-' . sprintf("%03s", $newNumber);
        } else {
            $newCode = 'S-001';
        }

        return $newCode;
    }
}
