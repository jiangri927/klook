<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeGallery extends Model
{
    use HasFactory;
    protected  $table = 'welcome_gallery';
    protected  $guarded = [];
}
