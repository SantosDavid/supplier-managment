<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\Admin\Company;
use App\Models\Tenant\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;
    
    private $company;

    public function setUp()
    {
        parent::setUp();

        $this->company = factory(Company::class)->create();

        $user = factory(User::class)->raw();

        $this->company->users()->create(
            array_merge($user, ['company_id' => $this->company->id])
        );

        $this->actingAs(User::first(), 'users');
    }

    public function testAccessAnotherCompany()
    {
        $response = $this->json('GET', '/api/5000/suppliers');


        $response->assertStatus(403);
    }

    public function testSucceful()
    {
        $response = $this->json('GET', '/api/'. $this->company->id .'/suppliers');


        $response->assertStatus(200);
    }
}
