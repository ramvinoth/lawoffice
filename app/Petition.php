<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Petition extends Model
{
    use FilterPaginateOrder;
    
    protected $table = 'petition';
 
    public function caselist()
    {
        return $this->belongsTo(CaseList::class);
    }
}
?>