<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceSubscription extends Model
{
    use HasFactory;

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class); // se establece relacion de mucho a uno con subscripcion
    }
}
