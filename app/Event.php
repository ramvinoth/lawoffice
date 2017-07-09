<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'EVENTS';
    
    protected $fillable = ['org_id', 'title', 'start', 'end', 'type_id', 'created_at', 'updated_at'];
    
    public static function initialize()
    {
        $events_table = ['title' => '', 'start' => '', 'end' => '', 'type_id' => '', 'created_at' => '', 'updated_at' => ''];
        
        return $events_table;
    }
}
?>