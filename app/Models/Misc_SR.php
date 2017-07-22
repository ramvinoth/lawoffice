<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Misc_SR extends BaseModel
{
    use FilterPaginateOrder;
    
    protected $table = 'misc_sr';
 
    public function caselist()
    {
        return $this->belongsTo(CaseList::class);
    }
}
?>