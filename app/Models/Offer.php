<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    public function hospital()
    {
        return $this->hasOne(User::class,'id','hospital_id');
    }
}
