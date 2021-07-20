<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartTicket extends Model
{
    use HasFactory;
    protected $table = 'cart_tickets';
    protected $guarded = [];

    function ticket_title(){
        return $this->hasMany(PackageTicket::class,'id','ticket_id')->first()->title;
    }
}
