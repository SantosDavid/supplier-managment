<?php

namespace Tests\Feature\Company;

use App\Models\Administrator\Admin;
use App\Models\Admin\Company;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admins');
    }

    public function testCreateCompanyWithWrongData()
    {
        $response = $this->json('POST', 'api/administrators/companies', []);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ]);
    }

    public function testCreateCompany()
    {
        $company = factory(Company::class)->states('relationships')->raw();

        $response = $this->json('POST', 'api/administrators/companies', $company);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Empresa cadastrada com sucesso!',
            ]);
    }

    public function testeCreateCompanyWithDuplicateCNPJ()
    {
        $company = factory(Company::class)->states('relationships')->make();

        $response = $this->json('POST', 'api/administrators/companies', $company->toArray());

        $response->assertStatus(422);
    }
}
