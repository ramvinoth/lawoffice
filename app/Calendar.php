<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
class Calendar extends Model
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