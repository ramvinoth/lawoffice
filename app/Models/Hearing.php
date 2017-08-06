<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
use App\Traits\CommonTrait;

class Hearing extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    use CommonTrait;
    
    protected $table = 'HEARINGS';
    
    protected $fillable = ['case_id', 'title', 'date', 'description', 'judges', 'created_at', 'updated_at'];
    
    protected $filter = ['id', 'case_id', 'title', 'date', 'description', 'judges', 'created_at', 'updated_at'];
    
    
    public function setDateAttribute($date)
    {
        return $this->convertDateToLong($date);
    }
    
    public function setCreatedAtAttribute($created_at)
    {
        return $this->convertDateToLong($created_at);
    }
    
    public function setUpdatedAtAttribute($updated_at)
    {
        return $this->convertDateToLong($updated_at);
    }
    
    public function getCreatedAtAttribute($created_at)
    {
        return $this->convertLongToDate($created_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getUpdatedAtAttribute($updated_at)
    {
        return $this->convertLongToDate($updated_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getDateAttribute($updated_at)
    {
        return $this->convertLongToDate($updated_at, 'd-m-Y', 'Asia/Calcutta');
    }
    
    public static function initialize()
    {
        $hearings_table = ['case_id' => '', 'title' => '', 'date' => '', 'description' => '', 'judges' => ''];
        
        return $hearings_table;
    }
}
?>