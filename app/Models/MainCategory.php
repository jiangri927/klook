<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected  $table = 'main_category';
    protected  $guarded = [];

    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','main_category')->where('index',null);
    }

    function indexImage(){
        return $this->hasOne(WelcomeGallery::class,'kind_id','id')->where('kind','main_category')->where('index',1)->first();
    }
    function subCategory(){
        return $this->hasMany(SubCategory::class,'parent_id','id');
    }
}
