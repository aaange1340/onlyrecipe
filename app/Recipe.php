<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
      'name','category_id','image','user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function category()
    {
      return $this->belongsTo('App\Category');
    }
    
    public function materials()
    {
      return $this->hasMany('App\Material');
    }
    
    public function likes()
    {
      return $this->hasMany('App\Like');  
    }
    public function likedUsers()
    {
      return $this->belongsToMany('App\User','likes');
    }
    public function isLikedBy($user)
    {
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    
    public function comments()
    {
      return $this->hasMany('App\Comment');  
    }
      
              
}
