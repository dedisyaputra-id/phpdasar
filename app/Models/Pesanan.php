<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pesanandetails()
    {
        return $this->hasMany(Pesanandetail::class, 'pesanan_id', 'id');
    }
}
