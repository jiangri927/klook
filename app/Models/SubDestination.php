<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDestination extends Model
{
    use HasFactory;
    protected  $table = 'sub_destination';
    protected  $guarded = [];
    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','s_dest')->where('index',null);
    }

    function indexImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','s_dest')->where('index',1)->first();
    }
    function mTitle(){
        return $this->hasOne(MainDestination::class,'id','main_destination_id')->first()->title;
    }
    function regionTitle(){
        return $this->hasOne(Region::class,'id','region_id')->first()->title;
    }
}
