<?php

namespace App\Models;

use App\Models\Pesanandetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    public function pesanandetails()
    {
        return $this->HasMany(Pesanandetail::class);
    }
}
