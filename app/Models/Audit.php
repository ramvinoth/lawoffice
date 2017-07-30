<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
use Auth;

class Audit extends BaseModel
{
    protected $table="AUDITS";
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    protected $fillable = ['org_id','act_id','act_type','act_by','act_module','act_time'];
    
    // whitelist of filter-able columns
    protected $filter = ['id','org_id','act_id','act_type','act_by','act_module','act_time'];
}
?>