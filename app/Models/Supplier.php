<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pembelianDetail(){
        return $this->belongsTo(PembelianDetail::class,'kode_supplier','kode_supplier');
    }
}