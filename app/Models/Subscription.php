<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class); // se establece relacion con la informacion del cliente uno a uno inversa
    }

    public function recurrent()
    {
        return $this->hasOne(Recurrent::class); // relacion con recurrencias uno a uno inversas
    }

    public function price_subs()
    {
        return $this->hasOne(PriceSubscription::class, 'id', 'price_id'); //Relacion de uno a mucho con precios de la suscripcion
    }

    public function subs_rec_trie()
    {
        return $this->hasMany(SubscriptionRecurrentTrie::class); //Relacion con los intento de uno a mucho con intentos registrados
    }
}
