<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserType extends Authenticatable
{
    // use HasApiTokens,Notifiable;

    protected $fillable = [
        'name',
        'updated_at',
        'created_at'
    ];

}
