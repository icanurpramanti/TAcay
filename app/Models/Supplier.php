<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public static function generateKode()
    {
        $latestSupplier = static::orderBy('id', 'desc')->first();

        if ($latestSupplier) {
            $lastCode = $latestSupplier->kode_supplier;
            $lastNumber = (int)substr($lastCode, 2);
            $newNumber = $lastNumber + 1;
            $newCode = 'R-' . sprintf("%03s", $newNumber);
        } else {
            $newCode = 'R-001';
        }

        return $newCode;
    }

}
