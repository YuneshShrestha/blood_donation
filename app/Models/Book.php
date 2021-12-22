<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }
    public function offer()
    {
        return $this->hasOne(Offer::class,'id','offer_id');
    }
}
