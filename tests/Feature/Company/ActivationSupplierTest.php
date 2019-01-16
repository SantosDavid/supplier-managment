<?php

namespace Tests\Feature\Company;

use App\Models\Company\Company;
use App\Models\Company\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use DB;

class ActivationSupplierTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $supplier;

    public function setUp()
    {
        $this->company = factory(Company::class)->create();

        $user = factory(User::class)->raw();

        $this->user = $this->company->users()->create(
            array_merge($user, ['company_id' => $this->company->id])
        );
    }

    public function testSupllierNonexistent()
    {
        
    }
}
