<?php

namespace Tests\Feature\Administrator;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrator\Admin;
use App\Models\Company\Company;
use App\Models\Company\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private $admin = [
        'email' => 'test@test.com',
        'password' => 'test',
    ];

    public function testWithWithUser()
    {
        $company = factory(Company::class)->create();

        $company->users()->create(
            array_merge(factory(User::class)->raw(), ['company_id' => $company->id])
        );
        
        $response = $this->json('POST', 'api/administrators/login', $company->users[0]->toArray());

        $response->assertStatus(401);
    }

    public function testWithWrongCredentials()
    {
        $response = $this->json('POST', 'api/administrators/login', $this->admin);

        $response->assertStatus(401);
    }

    public function testSuccefull()
    {
        Admin::create($this->admin);

        $response = $this->json('POST', 'api/administrators/login', $this->admin);

        $response->assertStatus(200);
    }
}
