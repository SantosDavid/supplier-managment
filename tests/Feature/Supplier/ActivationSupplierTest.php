<?php

namespace Tests\Feature\Supplier;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin\Company;
use App\Models\Tenant\User;
use App\Models\Tenant\Supplier;
use Bus;

class ActivationSupplierTest extends TestCase
{
    use RefreshDatabase;

    private $endpoint = 'api/suppliers/activation/';

    public function testWithNonexistentSupplier()
    {
        $response = $this->json('GET', $this->endpoint .  'token');

        
        $response->assertStatus(400);
    }

    public function testSuccefull()
    {
        Bus::fake();

        $company = factory(Company::class)->create();

        $user = $company->users()->create(
            array_merge(
                factory(User::class)->raw(),
                ['company_id' => $company->id]
            )
        );

        $this->actingAs($user, 'users');

        $response = $this->json(
            'POST',
            "api/" . $company->id . "/suppliers/",
            factory(Supplier::class)->raw()
        );

        $supplier = Supplier::first();


        $response = $this->json(
            'GET',
            $this->endpoint . $supplier->active[0]->token
        );

        
        $response->assertStatus(200);
    }
}
