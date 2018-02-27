<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
use Auth;

class Library extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    
    protected $table = 'library';
    
    protected $fillable = ['org_id','ldate','book', 'author', 'created_at', 'updated_at'];
    
    protected $filter = ['id', 'ldate','book', 'author'];

    
    public static function initialize()
    {
        $library_table = ['org_id' => Auth::user()->org_id, 'ldate' => '', 'book' => '', 'author' => ''];
        
        return $library_table;
    }
}
