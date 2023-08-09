<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'id';
    protected $guarded=[];
    

    public static function generateKode()
    {
        $latestProduk = static::orderBy('id', 'desc')->first();

        if ($latestProduk) {
            $lastCode = $latestProduk->kode_produk;
            $lastNumber = (int)substr($lastCode, 2);
            $newNumber = $lastNumber + 1;
            $newCode = 'P-' . sprintf("%03s", $newNumber);
        } else {
            $newCode = 'P-001';
        }

        return $newCode;
    }
    

    public function kategori(){
        return $this-> belongsTo(Kategori::class,'kode_kategori');
  }

    public function satuan(){
        return $this-> belongsTo(Satuan::class,'kode_satuan');
    }


    
}
