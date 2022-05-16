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
    
    public function answers()
    {
        return $this->belongsTo('App\Answer');
    }
}
