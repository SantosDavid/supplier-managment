<?php

namespace App\Events;

use App\Models\Company\Company;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompanyCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $company;

    public $users;

    public function __construct(Company $company, Array $users)
    {
        $this->company = $company;

        $this->users = $users;
    }
}
