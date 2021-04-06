<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanandetail extends Model
{
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
