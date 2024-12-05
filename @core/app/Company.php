<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country_id',
        'service_city',
        'service_area',
        'post_code',
        'image',
        'profile_background',
        'gstin',
    ];

    public function company(){
        return $this->belongsTo(User::class,'company_id','id');
    }
}
