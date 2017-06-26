<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class CaseList extends Model
{
    use FilterPaginateOrder;
    
    protected $table = 'cases';
    
    protected $fillable = [
        'court', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'respondant', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority'
    ];

    // whitelist of filter-able columns
    protected $filter = [
        'id', 'court', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'respondant', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority'
    ];
    
    public function misc_sr()
    {
        return $this->hasMany(Misc_SR::class);
    }
    
    public function petition()
    {
        return $this->hasMany(Petition::class);
    }
    
    public static function initialize()
    {
        $cases_table = [
            'court' => '', 'bench' => '', 'sno' => '', 'vno' => '', 'case_type' => '', 'filing_date' => '', 'admission' => '', 'petitioner' => '', 'respondant' => '', 'appear' => '', 'contact' => '', 'no_of' => '', 'refer_by' => '', 'refer_contact' => '', 'refer_to' => '', 'to_contact' => '', 'district' => '', 'c_prayer' => '', 'citation' => '', 'status' => '', 's_text' => '', 'disposal' => '', 'expiry_date' => '', 'by_whom' => '', 'category' => '', 'case_no' => '', 'against' => '', 'against1' => '', 'mcdisposal' => '', 'mcjudge' => '', 'judge' => '', 'main_petitioner' => '', 'posted_date' => '', 'mpno' => '', 'other' => '', 'crime_no' => '', 'police_st' => '', 'loan' => '', 'bank' => '', 'branch' => '', 'loan_cat' => '', 'possession' => '', 'sale' => '', 'upload' => '', 'returned' => '', 'represent' => '', 'present' => '', 'return_expiry' => '', 'result' => '', 'priority' => ''
        ];
        $connected_table = ["connected" => ''];
        
        $misc_sr_table = ["misc_sr" => ''];
        
        $merged_arr = array_merge($cases_table, $connected_table, $misc_sr_table);
        
        return $merged_arr;
    }

}
