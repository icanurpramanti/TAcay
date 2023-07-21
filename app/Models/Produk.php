<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded=[];

    

    public function kategori(){
        return $this-> belongsTo(Kategori::class,'kode_kategori');
  }

    public function satuan(){
        return $this-> belongsTo(Satuan::class,'kode_satuan');
    }

//     public function pembelian_detail(){
//         return $this-> belongsTo(PembelianDetail::class,'kode_pembelian');
//   }

    
}
