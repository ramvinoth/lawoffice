<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompanyMapping extends Model
{
    protected $table = 'UserCompanyMapping';
    protected $fillable = ['org_id','user_id','role_id'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
    
    public function company()
    {
        return $this->hasMany('App\Models\Company');
    }
}
