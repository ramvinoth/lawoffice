<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends BaseModel
{
    protected $fillable = ['requester','user_requested','status'];
}
