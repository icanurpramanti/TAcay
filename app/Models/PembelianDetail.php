<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table='pembelian_details';
    protected $primaryKey='id';
    protected $guarded=[];
  

    public function produk()
    {
        return $this->hasOne(Produk::class, 'kode_produk', 'kode_produk');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'kode_supplier', 'kode_supplier');
    }
  
}
