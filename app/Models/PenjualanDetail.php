<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function produks()
    {
        return $this->hasOne(Produk::class, 'kode_produk', 'kode_produk');
    }
}
