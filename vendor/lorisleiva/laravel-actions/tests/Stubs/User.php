<?php

namespace Lorisleiva\Actions\Tests\Stubs;

use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
