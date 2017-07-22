<?php

namespace App\Models;
use App\Models\BaseModel
use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
class Calendar extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    
    protected $table = 'calendar';
    
    protected $fillable = [];
    
}
?>