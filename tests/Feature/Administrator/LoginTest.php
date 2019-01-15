<?php

namespace Tests\Feature\Administrator;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrator\Admin;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private $admin = [
        'email' => 'test@test.com',
        'password' => 'test',
    ];

    public function testLoginWithWrongCredentials()
    {
        $response = $this->json('POST', 'api/administrators/login', $this->admin);

        $response->assertStatus(401);
    }

    public function testLoginSuccefull()
    {
        Admin::create($this->admin);

        $response = $this->json('POST', 'api/administrators/login', $this->admin);

        $response->assertStatus(200);
    }
}
