<?php

namespace App\Models\UserTypes;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Base
{
    protected $table = 'users_suppliers';

    protected $fillable = [
        'quick_notify'
    ];

    protected $casts = [
        'quick_notify' => 'boolean'
    ];

    public function getParametersAttribute()
    {
        return [
            'quick_notify' => $this->quick_notify
        ];
    }
}
