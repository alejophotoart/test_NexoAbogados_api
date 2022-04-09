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
        return $this->belongsTo(User::class);
    }

    public function date_recurrent()
    {
        return $this->belongsTo(Recurrent::class);
    }

    public function price_subs()
    {
        return $this->hasOne(PriceSubscription::class, 'id', 'price_id');
    }
}
