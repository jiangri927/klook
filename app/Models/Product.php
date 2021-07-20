<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];
    
    function getPackage(){
        return $this->hasMany('App\Models\ProductPackage','product_id','id');
    }

    function firstImage(){
        return $this->hasOne('App\Models\ProductGallery','product_id','id')->where('kind','index');
    }
    function firstPackage(){
        return $this->hasOne('App\Models\ProductPackage','product_id','id')->where('ticket','<>',0)->oldest();
    }

    function images(){
        return $this->hasMany('App\Models\ProductGallery','product_id','id')->where('kind','banner');
    }
}
