<?php

namespace Tests\Unit\Administrator;

use App\Models\Administrator\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAdminWithWrongData()
    {
        $data = [
            'email' => 'test',
            'password' => '1',
        ];

        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admins')
            ->json('POST', 'api/administrators/admins', $data);

        $response->assertStatus(422);
    }

    public function testCreateAdmin()
    {
        $data = [
            'email' => 'test@test.com.br',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admins')
            ->json('POST', 'api/administrators/admins', $data);

        $response->assertStatus(201);

        $response->assertJson(['message' => 'Administrador criado com sucesso!']);
    }

    public function testDeleteAdmin()
    {
        $admin = factory(Admin::class)->create();

        $response = $this->actingAs($admin, 'admins')
            ->json('DELETE', "api/administrators/admins/$admin->id");

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Administrador deletado com sucesso!']);
    }
}
