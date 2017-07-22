<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyScope;

class Event extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    protected $table = 'EVENTS';
    
    protected $fillable = ['org_id', 'title', 'start', 'end', 'type_id', 'created_at', 'updated_at'];
    
    public static function initialize()
    {
        $events_table = ['title' => '', 'start' => '', 'end' => '', 'type_id' => ''];
        
        return $events_table;
    }
}
?>