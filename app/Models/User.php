<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'api_token',
        'slack_webhook',
    ];

    protected $dates = ['created_at', 'updated_at', 'email_verified_at',];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ********************* MODIFICATIONS ************************** */

    public function routeNotificationForSlack($notification)
    {
        return $this->slack_webhook;
    }
}
