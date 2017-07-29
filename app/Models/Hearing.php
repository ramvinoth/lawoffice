<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;

class Hearing extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    
    protected $table = 'HEARINGS';
    
    protected $fillable = ['case_id', 'title', 'date', 'description', 'judges', 'created_at', 'updated_at'];
    
    protected $filter = ['id', 'case_id', 'title', 'date', 'description', 'judges', 'created_at', 'updated_at'];
    
    
    public static function initialize()
    {
        $hearings_table = ['case_id' => '', 'title' => '', 'date' => '', 'description' => '', 'judges' => ''];
        
        return $hearings_table;
    }
}
?>