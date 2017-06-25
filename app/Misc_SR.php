<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Misc_SR extends Model
{
    use FilterPaginateOrder;
    
    protected $table = 'misc_sr';
 
    public function caselist()
    {
        return $this->belongsTo(CaseList::class);
    }
}
?>