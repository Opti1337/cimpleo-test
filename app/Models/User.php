<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'parameters'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $user) {
            $user->type()->create([
                'id' => $user->id
            ]);
        });
    }

    public function user_type()
    {
        return $this->morphTo('user_type', 'type', 'id');
    }

    public function getParametersAttribute()
    {
        return $this->user_type->parameters;
    }

    public function isWriter()
    {
        return $this->user_type instanceof UserTypes\Writer;
    }

    public function isSupplier()
    {
        return $this->user_type instanceof UserTypes\Supplier;
    }

    public function isAdmin()
    {
        return $this->user_type instanceof UserTypes\Admin;
    }

    public function scopeWriters($query)
    {
        return $query->where('type', UserTypes\Writer::class);
    }

    public function scopeSuppliers($query)
    {
        return $query->where('type', UserTypes\Supplier::class);
    }

    public function scopeAdmins($query)
    {
        return $query->where('type', UserTypes\Admin::class);
    }
}
