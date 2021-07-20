<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected  $table = 'sub_category';
    protected  $guarded = [];
    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','sub_category')->where('index',null);
    }

    function indexImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','sub_category')->where('index',1)->first();
    }

    function firstImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','sub_category')->oldest();
    }
    function mainCategory(){
        return $this->hasOne(MainCategory::class,'id','parent_id')->first()->title;
    }
}
