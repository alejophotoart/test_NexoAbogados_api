<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionRecurrentTrie extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function subscrition()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id'); // se establece relacion de uno a mucho con suscripciones
    }

    public function recurrent()
    {
        return $this->hasOne(Recurrent::class); // se establece relacion de uno a mucho con recurrencias
    }
}
