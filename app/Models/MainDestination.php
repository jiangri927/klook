<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDestination extends Model
{
    use HasFactory;
    protected  $table = 'main_destination';
    protected  $guarded = [];

    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','m_dest')->where('index',null);
    }

    function indexImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','m_dest')->where('index',1)->first();
    }
    function s_dest(){
        return $this->hasMany(SubDestination::class,'main_destination_id','id');
    }

    function regionTitle(){
        return $this->hasOne(Region::class,'id','region_id')->first()->title;
    }
}
