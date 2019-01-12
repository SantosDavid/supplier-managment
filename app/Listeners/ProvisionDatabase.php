<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Tenant\DatabaseService;

class ProvisionDatabase // implements ShouldQueue
{
    private $service;

    public function __construct(DatabaseService $service)
    {
        $this->service = $service;
    }

    public function handle(CompanyCreated $event)
    {
        $this->service->provision($event->company, $event->users);
    }
}
