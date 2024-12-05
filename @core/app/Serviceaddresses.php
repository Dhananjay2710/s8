<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviceaddresses extends Model
{
    use HasFactory;

    protected $table = 'serviceaddresses';
    protected $fillable = [
        'service_id', 
        'seller_id', 
        'service_city_id', 
        'service_area_id', 
        'service_post_code'
    ];
}
