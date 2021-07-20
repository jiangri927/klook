<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected  $table = 'region';
    protected  $guarded = [];

    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','region')->where('index',null);
    }

    function indexImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','region')->where('index',1)->first();
    }

    function m_dest(){
        return $this->hasMany(MainDestination::class,'region_id','id');
    }
}
