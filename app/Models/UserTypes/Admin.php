<?php

namespace App\Models\UserTypes;

use Illuminate\Database\Eloquent\Model;

class Admin extends Base
{
    protected $table = 'users_admins';

    protected $fillable = [
        'low_sms_notification'
    ];

    protected $casts = [
        'low_sms_notification' => 'boolean'
    ];

    public function getParametersAttribute()
    {
        return [
            'low_sms_notification' => $this->low_sms_notification
        ];
    }
}
