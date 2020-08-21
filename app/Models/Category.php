<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    function questions(){
        return $this->hasMany(Question::class);
    }
}
