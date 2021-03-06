<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['recipe_id','user_id','body'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
}
