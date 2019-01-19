<?php

namespace Tests\Feature\Admin;

use App\Models\Administrator\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private $adminLogin;

    public function setUp()
    {
        parent::setUp();

        $this->adminLogin = factory(Admin::class)->create();
    }

    public function testCreateAdminWithWrongData()
    {
        $admin = ['email' => 'test', 'password' => '1'];


        $response = $this->actingAs($this->adminLogin, 'admins')
            ->json('POST', 'api/administrators/admins', $admin);


        $response->assertStatus(422);
    }

    public function testCreateAdmin()
    {
        $admin = factory(Admin::class)->states('create')->raw();


        $response = $this->actingAs($this->adminLogin, 'admins')
            ->json('POST', 'api/administrators/admins', $admin);


        $response
            ->assertStatus(201)
            ->assertJson(['message' => 'Administrador criado com sucesso!']);
    }

    public function testDeleteAdmin()
    {
        $response = $this->actingAs($this->adminLogin, 'admins')
            ->json(
                'DELETE',
                'api/administrators/admins/' . $this->adminLogin->id
            );


        $response->assertStatus(200)
            ->assertJson(['message' => 'Administrador deletado com sucesso!']);
    }
}
