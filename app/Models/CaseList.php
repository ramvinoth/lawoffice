<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;
use App\Traits\Audit;
use App\Traits\CommonTrait;
use App\Traits\CaseListTrait;
use Auth;
use DateTime;

class CaseList extends BaseModel
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
    
    use FilterPaginateOrder;
    use Audit;
    use CommonTrait;
    use CaseListTrait;
    
    protected $table = 'cases';
    public $timestamps = false;
    //protected $attributes = ['org_id' => Auth::user()->org_id];
    
    protected $hidden = ['created_at'];
    
    protected $fillable = [
        'case_title', 'court_type_id', 'court_id', 'state_id', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'petitioner_addr', 'respondant', 'respondant_addr', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'subject', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority', 'created_at', 'updated_at'
    ];

    // whitelist of filter-able columns
    protected $filter = [
        'id', 'case_title', 'court_type_id', 'court_id', 'state_id', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'petitioner_addr', 'respondant', 'respondant_addr', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'subject', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority'
    ];
    
    public function misc_sr()
    {
        return $this->hasMany(Misc_SR::class);
    }
    
    public function petition()
    {
        return $this->hasMany(Petition::class);
    }
    
    public function getCreatedAtAttribute($created_at)
    {
        return $this->convertLongToDate($created_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getUpdatedAtAttribute($updated_at)
    {
        return $this->convertLongToDate($updated_at, 'd-m-Y H:i:s', 'Asia/Calcutta');
    }
    
    public function getPriorityAttribute($priority)
    {
        $priority_txt = "Low";
        if($priority == 2){
            $priority_txt = "Medium";
        }else if($priority == 3){
            $priority_txt = "High";
        }
        return $priority_txt;
    }
    
    public function setPriorityAttribute($priority)
    {
        $priority_txt = 1;
        if($priority == "Medium"){
            $priority_txt = 2;
        }else if($priority == "High"){
            $priority_txt = 3;
        }
        $this->attributes['priority'] = $priority_txt;
    }
    
    public static function initialize()
    {
        $curr_date = CommonTrait::getDatetimeNow();
        $cases_table = [
            'court_type_id' => '2',
            'case_title' => '',
            'court_id' => '507',
            'state_id' => '',
            'bench' => '',
            'sno' => '',
            'vno' => '',
            'case_type' => '',
            'filing_date' => $curr_date,
            'admission' => $curr_date,
            'petitioner' => '',
            'petitioner_addr' => '',
            'respondant' => '',
            'respondant_addr' => '',
            'appear' => '',
            'contact' => '',
            'no_of' => '',
            'refer_by' => '',
            'refer_contact' => '',
            'refer_to' => '',
            'to_contact' => '',
            'district' => '',
            'c_prayer' => '',
            'citation' => '',
            'status' => '',
            's_text' => '',
            'disposal' => '',
            'expiry_date' => '',
            'by_whom' => '',
            'category' => '',
            'subject' => '',
            'case_no' => '',
            'against' => ['lno'=> '', 'lcourt'=> '', 'lplace'=> '', 'lorder'=> ''],
            'against1' => ['lno'=> '', 'lcourt'=> '', 'lplace'=> '', 'lorder'=> ''],
            'mcdisposal' => '',
            'mcjudge' => '',
            'judge' => '',
            'main_petitioner' => '',
            'posted_date' => '',
            'mpno' => '',
            'other' => array(['other_counsel'=>'', 'contact'=>'']),
            'crime_no' => '',
            'police_st' => '',
            'loan' => '',
            'bank' => '',
            'branch' => '',
            'loan_cat' => '',
            'possession' => '',
            'sale' => '',
            'upload' => '',
            'returned' => '',
            'represent' => '',
            'present' => '',
            'return_expiry' => '',
            'result' => '',
            'priority' => 'Low',
        ];
        $connected_table = ["connected" => ''];
        
        $misc_sr_table = ["misc_sr" => array(['category' => '', 'sr_no' => '', 'year' => '', 'date' => ''])];
        
        $misc_pet_table = ["misc_pet" => array(['mptype' => '', 'mpno' => '', 'mpprayer' => '', 'mpdisposal' => '', 'mpfiling' => '', 'mpreturn' => '', 'mprepresent' => ''])];
        
        $merged_arr = array_merge($cases_table, $connected_table, $misc_sr_table, $misc_pet_table);
        
        return $merged_arr;
    }

}
