<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Calendar extends Model
{
    use FilterPaginateOrder;
    
    protected $table = 'calendar';
    
    protected $fillable = [];
    
}
?>