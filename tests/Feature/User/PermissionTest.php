<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\Admin\Company;
use App\Models\Tenant\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Seeder;

class PermissionTest extends TestCase
{
    use RefreshDatabase;
    use Seeder;
    
    private $company;

    public function setUp()
    {
        parent::setUp();

        $this->runSeeder(['CompaniesTableSeeder', 'UsersTableSeeder']);

        $this->company = Company::first();

        $this->actingAs($this->company->users[0], 'users');
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
