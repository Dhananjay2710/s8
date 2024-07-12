<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerVerify extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'national_id',
        'address',
        'verification_data',
        'status',
    ];
    
    protected $casts = [
        'seller_id' => 'integer',
        'status' => 'integer'
    ];
}
