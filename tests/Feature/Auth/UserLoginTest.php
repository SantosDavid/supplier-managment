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
    
    public function testWithAdmin()
    {
        $admin = factory(Admin::class)->create();

        $response = $this->json('POST', 'api/companies/login', $admin->toArray());

        $response->assertStatus(401)
            ->assertJson([
                'message' => ['Não autorizado'],
            ]);
    }

    public function testWrongData()
    {
        $user = [
            'email' => 'test@test.com.br',
            'password' => '1231dfadf',
        ];

        $response = $this->json('POST', 'api/companies/login', $user);

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

        $response = $this->json('POST', 'api/companies/login', $user);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['token'],
            ]);
    }
}
