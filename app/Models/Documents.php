<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyScope;
use App\Traits\Audit;
use App\Traits\CommonTrait;
use App\Traits\CaseListTrait;
use Storage;
use Auth;

class Documents extends BaseModel
{
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
    use CommonTrait;
    
    protected $table = 'Documents';
    
    protected $fillable = ['attachement_id','case_id', 'path', 'name', 'status', 'deleted_at'];
    
    public function setDeletedAtAttribute($deleted_at)
    {
        $deleted_at = (new DateTime())->format('d-m-Y');
        $this->attributes['$deleted_at'] = $this->convertDateToLong($deleted_at);
    }
    
    public function getDeletedAtAttribute($deleted_at)
    {
        return $this->convertLongToDate($deleted_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getPathAttribute($path)
    {
        return asset(Storage::url($path));
    }
}