<?php 

namespace App\Traits;

use App\Scopes\CompanyScope;

trait CompanyTrait
{
    
    public function __construct(array $attributes = [])
    {
      parent::__construct(array_merge($attributes, ['cust_id' => $this->custId]));
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