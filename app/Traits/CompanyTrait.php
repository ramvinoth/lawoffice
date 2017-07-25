<?php 

namespace App\Traits;

use App\Scopes\CompanyScope;
use Auth;

trait CompanyTrait
{
    
    public function __construct(array $attributes = [])
    {
      parent::__construct(array_merge($attributes, ['org_id' => Auth::user()->org_id]));
    }
    /**
     * Boot the scope.
     * 
     * @return void
     */
    public static function bootCompanyTrait()
    {
        static::addGlobalScope(new CompanyScope());
    }

    /**
     * Get all tenants.
     * 
     * @return string
     */
    public static function allTenants()
    {
        return (new static())->newQueryWithoutScope(new CompanyScope());
    }
}