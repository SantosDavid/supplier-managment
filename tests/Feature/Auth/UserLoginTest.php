<?php

namespace Tests\Feature\Auth;

use App\Models\Administrator\Admin;
use App\Models\Admin\Company;
use App\Models\Tenant\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    
    private $endpointLogin = "api/1/login";

    public function testWithAdmin()
    {
        $admin = factory(Admin::class)->create();


        $response = $this->json('POST', $this->endpointLogin, $admin->toArray());


        $response->assertStatus(401)
            ->assertJson([
                'message' => ['Não autorizado'],
            ]);
    }

    public function testWrongData()
    {
        $user = factory(User::class)->states('create')->raw();


        $response = $this->json('POST', $this->endpointLogin, $user);


        $response->assertStatus(401)
            ->assertJson([
                'message' => ['Não autorizado'],
            ]);
    }

    public function testSuccefull()
    {
        $company = factory(Company::class)->create();

        $user = factory(User::class)->raw();

        $company->users()->create(
            array_merge($user, ['company_id' => $company->id])
        );


        $response = $this->json('POST', "api/$company->id/login", $user);

        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token'],
            ]);
    }
}
