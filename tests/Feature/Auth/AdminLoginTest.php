<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrator\Admin;
use App\Models\Admin\Company;
use App\Models\Tenant\User;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testWithUser()
    {
        $company = factory(Company::class)->create();

        $company->users()->create(
            array_merge(
                factory(User::class)->raw(),
                ['company_id' => $company->id]
            )
        );
        

        $response = $this->json(
            'POST',
            'api/administrators/login',
            $company->users[0]->toArray()
        );
        

        $response->assertStatus(401);
    }

    public function testWithWrongCredentials()
    {
        $admin = factory(Admin::class)->raw();


        $response = $this->json('POST', 'api/administrators/login', $admin);

        
        $response->assertStatus(401);
    }

    public function testSuccefull()
    {
        $admin = factory(Admin::class)->states('create')->raw();

        Admin::create($admin);


        $response = $this->json('POST', 'api/administrators/login', $admin);


        $response->assertStatus(200);
    }
}
