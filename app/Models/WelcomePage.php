<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomePage extends Model
{
    use HasFactory;

    protected  $table = 'welcome_page';
    protected  $guarded = [];

    function images(){
        return $this->hasMany(WelcomeGallery::class,'kind_id','id')->where('kind','welcome');
    }
}
