<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
      'comment_id','body','user_id','recipe_id'  
    ];
    
    public function comment()
    {
      return $this->hasOne('App\Comment');
    }
    
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}