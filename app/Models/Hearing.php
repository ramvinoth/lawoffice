<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
use App\Traits\CommonTrait;
use DateTime;

class Hearing extends BaseModel
{
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
    
    use FilterPaginateOrder;
    use CommonTrait;
    
    protected $table = 'diary';
    
    public $timestamps = false;
    
    protected $fillable = ['org_id', 'case_id', 'case_no', 'item', 'to_whom', 'status', 'what', 'posted', 'judges', 'created_at', 'updated_at'];
    
    protected $filter = ['id','case_id', 'mpno', 'srno', 'case_no', 'cdate', 'item', 'to_whom', 'status', 'what', 'posted', 'created_at', 'updated_at'];
    
    
    public function setPostedAttribute($posted)
    {
        $this->attributes['posted'] = $this->convertDateToLong($posted);
    }
    
    public function setCreatedAtAttribute($created_at)
    {
        $created_at = (new DateTime())->format('d-m-Y');
        $this->attributes['created_at'] = $this->convertDateToLong($created_at);
    }
    
    public function setUpdatedAtAttribute($updated_at)
    {
        $updated_at = (new DateTime())->format('d-m-Y');
        $this->attributes['updated_at'] = $this->convertDateToLong($updated_at);
    }
    
    public function getCreatedAtAttribute($created_at)
    {
        return $this->convertLongToDate($created_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getPostedAttribute($posted)
    {
        return $this->convertLongToDate($posted, 'd-m-Y', 'Asia/Calcutta');
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
        $hearings_table = ['case_id' => '', 'mpno' => '', 'srno' => '', 'case_no' => '', 'cdate' => '', 'item' => '', 'to_whom' => '', 'status' => '', 'what' => '', 'posted' => ''];
        
        return $hearings_table;
    }
}
?>