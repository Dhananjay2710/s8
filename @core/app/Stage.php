<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $table = 'stages';
    protected $fillable = ['pipeline_id','stage_name','stage_action_key','status'];

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class, 'pipeline_id', 'id');
    }
}
