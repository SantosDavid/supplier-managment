<?php

namespace App\Models\Tenant;

class Supplier extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'monthly_payment',
        'company_id',
    ];

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
