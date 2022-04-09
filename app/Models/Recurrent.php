<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurrent extends Model
{
    use HasFactory;

    public function subcription()
    {
        return $this->hasOne(subcription::class);
    }
}
