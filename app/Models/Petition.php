<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;

class Petition extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    
    protected $table = 'petition';
 
    public function caselist()
    {
        return $this->belongsTo(CaseList::class);
    }
}
?>