<?php

namespace App\Services\Admin\Contracts;

use App\Models\Admin\Company;

interface CompanyServiceContract
{
    public function create(array $company, array $addresses, array $users): Company;
}
