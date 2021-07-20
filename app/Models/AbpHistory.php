<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbpHistory extends Model
{
    use HasFactory;
    protected $table = 'abp_history';
    protected $guarded = [];
}
