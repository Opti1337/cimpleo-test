<?php

namespace App\Models\UserTypes;

use Illuminate\Database\Eloquent\Model;

class Writer extends Base
{
    protected $table = 'users_writers';

    protected $fillable = [
        'quick_contact',
        'quick_reply'
    ];

    protected $casts = [
        'quick_contact' => 'boolean',
        'quick_reply' => 'boolean'
    ];

    public function getParametersAttribute()
    {
        return [
            'quick_contact' => $this->quick_contact,
            'quick_reply' => $this->quick_reply,
        ];
    }
}
