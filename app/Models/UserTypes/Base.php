<?php

namespace App\Models\UserTypes;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function user()
    {
        return $this->morphOne(App\Models\User::class, 'user_type');
    }

    public function getParametersAttribute() {
        return [];
    }
}