<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'EVENTTYPES';
    
    protected $fillable = ['org_id', 'name', 'color', 'created_at', 'updated_at'];
    
    public static function initialize()
    {
        $eventtypes_table = ['name' => '', 'color' => '', 'created_at' => '', 'updated_at' => ''];
        
        return $eventtypes_table;
    }
}
?>