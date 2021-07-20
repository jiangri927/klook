<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function HighlightUtilities\splitCodeIntoArray;

class ProductPackage extends Model
{
    use HasFactory;
    protected $table = 'product_package';
    protected $guarded = [];
    function firstTicket()
    {
        return $this->hasOne('App\Models\PackageTicket', 'package_id', 'id')->oldest();
    }

    function tickets(){
        return $this->hasMany('App\Models\PackageTicket', 'package_id', 'id');
    }
    function available_date()
    {
        $date = explode(',',$this->availability)[0];
        return $date;
    }
}
