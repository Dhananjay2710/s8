<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;
    protected $table = 'pipelines';
    protected $fillable = ['pipeline_name','pipeline_description','status'];

    public function stages(){
        return $this->hasMany(Stage::class,'pipeline_id','id');
    }
}
