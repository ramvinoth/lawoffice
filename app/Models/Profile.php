<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends BaseModel
{
    protected $fillable = ['location','about','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}