<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //protected $guarded = [];
    protected $fillable = ['title', 'body', 'user_id', 'category_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function getPathAttribute(){
        return'question/' . $this->id;
    }
}
