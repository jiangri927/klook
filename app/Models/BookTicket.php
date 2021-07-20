<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTicket extends Model
{
    use HasFactory;
    protected $table = 'book_ticket';
    protected $guarded = [];
    function ticket_title(){
        return $this->hasMany(PackageTicket::class,'id','ticket_id')->first()->title;
    }
}
