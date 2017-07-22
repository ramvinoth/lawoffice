<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;

class Diary extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    
    protected $table = 'diary';
    
    protected $fillable = ['cid', 'mpno', 'srno', 'case_no', 'cdate', 'item', 'to_whom', 'status', 'what', 'posted'];
    
    protected $filter = ['id', 'cid', 'mpno', 'srno', 'case_no', 'cdate', 'item', 'to_whom', 'status', 'what', 'posted'];
    
    
    public static function initialize()
    {
        $diary_table = ['cid' => '', 'mpno' => '', 'srno' => '', 'case_no' => '', 'cdate' => '', 'item' => '', 'to_whom' => '', 'status' => '', 'what' => '', 'posted' => ''];
        
        return $diary_table;
    }
}
?>