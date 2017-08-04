<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    protected $table="COMPANIES";
    
    
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    
}
?>