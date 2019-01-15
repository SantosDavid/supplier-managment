<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Scopes\CompanyScope;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'monthly_payment',
        'company_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }

    public function actived()
    {
        $this->verified = '1';

        $this->save();
    }

    public function scopeVerified($q)
    {
        return $q->where('verified', '1');
    }

    public function active()
    {
        return $this->hasMany(ActiveSupplier::class);
    }
}
