<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyScope;

class EventType extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    protected $table = 'EVENTTYPES';
    public $timestamps = false;
    
    protected $fillable = ['org_id', 'name', 'color', 'created_at', 'updated_at'];
    
    public static function initialize()
    {
        $eventtypes_table = ['name' => '', 'color' => '', 'created_at' => '', 'updated_at' => ''];
        
        return $eventtypes_table;
    }
}
?>