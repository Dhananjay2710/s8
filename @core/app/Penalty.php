<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    
    protected $table = 'penalties';
    protected $fillable = ['penalty_reason','status','description','penalty_percentage'];

    public function subcategories(){
        return $this->hasMany(Subcategory::class,'category_id','id');
    }
}
