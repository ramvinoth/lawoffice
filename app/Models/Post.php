<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{

    public $with = ['user','likes'];

    protected $fillable = ['content','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
