<?php

namespace App\Services\Admin;

use App\Models\Admin\Company;
use App\Services\Admin\Contracts\CompanyServiceContract;

class CompanyService implements CompanyServiceContract
{
    public function create(array $company, array $addresses, array $users): Company
    {
        $company = Company::create($company);

        foreach ($addresses as $address) {
            $company->addresses()->create($address);
        }

        foreach ($users as $user) {
            $company->users()->create($user);
        }

        return $company;
    }
}
