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
    
    protected $fillable = ['org_id', 'cid', 'sno', 'mpno', 'mptype', 'mpfiling', 'mpdisposal', 'mpprayer', 'mpreturn', 'mprepresent', 'created_at', 'updated_at'];
 
    public function caselist()
    {
        return $this->belongsTo(CaseList::class);
    }
}
?>