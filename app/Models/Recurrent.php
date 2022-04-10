<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurrent extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class)->with("user"); //se establece relacion inversa de uno a uno con subscripcion
    }

    public function subs_rec_trie()
    {
        return $this->hasMany(SubscriptionRecurrentTrie::class); //se establece relacion de mucho a uno con los intentos de pago registrados
    }
}
