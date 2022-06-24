<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Client extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, UsesTenantConnection;

        protected $guard = 'client';

        protected $fillable = [
            'name',
            'firstname',
            'email',
            'password',
            'phone',
            'address',
            'cp',
            'city',
        ];

        protected $hidden = [
            'password',
            'remember_token',
        ];

         /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
}
