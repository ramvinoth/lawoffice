<?php

namespace App\Models;
use Eloquent;
use Auth;

class BaseModel extends Eloquent{
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $user = Auth::user();            
            $model->org_id = $user->org_id;
            //$model->updated_by = $user->id;
        });
        /*
        static::updating(function($model)
        {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });  
        */
    }
    
}
?>