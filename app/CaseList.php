<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Scopes\CompanyScope;

class CaseList extends Model
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
    
    protected $table = 'cases';
    
    protected $fillable = [
        'case_title', 'court', 'subcourt', 'bench', 'sno', 'vno', 'case_type', 'filing_date', 'admission', 'petitioner', 'respondant', 'appear', 'contact', 'no_of', 'refer_by', 'refer_contact', 'refer_to', 'to_contact', 'district', 'c_prayer', 'citation', 'status', 's_text', 'disposal', 'expiry_date', 'by_whom', 'category', 'case_no', 'against', 'against1', 'mcdisposal', 'mcjudge', 'judge', 'main_petitioner', 'posted_date', 'mpno', 'other', 'crime_no', 'police_st', 'loan', 'bank', 'branch', 'loan_cat', 'possession', 'sale', 'upload', 'returned', 'represent', 'present', 'return_expiry', 'result', 'priority', 'created_at', 'updated_at'
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
            'court' => '',
            'case_title' => '',
            'bench' => '',
            'sno' => '',
            'vno' => '',
            'case_type' => '',
            'filing_date' => '',
            'admission' => '',
            'petitioner' => '',
            'respondant' => '',
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
            'case_no' => '',
            'against' => '',
            'against1' => '',
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
            'priority' => '',
            'subcourt' => ''
        ];
        $connected_table = ["connected" => ''];
        
        $misc_sr_table = ["misc_sr" => array(['category' => '', 'sr_no' => '', 'year' => '', 'date' => ''])];
        
        $misc_pet_table = ["misc_pet" => array(['mpno' => '', 'mpprayer' => '', 'mpdisposal' => '', 'mpreturn' => '', 'mprepresent' => ''])];
        
        $merged_arr = array_merge($cases_table, $connected_table, $misc_sr_table, $misc_pet_table);
        
        return $merged_arr;
    }

}
