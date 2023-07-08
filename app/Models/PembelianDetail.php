<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table='pembelian_details';
    protected $primarykey='kode_pembeliandetail';
    protected $guarded=[];
  

    public function produk()
    {
        return $this->hasOne(Produk::class, 'kode_produk', 'kode_produk');
    }
}
