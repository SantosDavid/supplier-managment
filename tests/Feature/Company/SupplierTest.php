<?php

namespace Tests\Feature\Company;

use App\Jobs\SendEmailSupplier;
use App\Models\Company\Company;
use App\Models\Company\Supplier;
use App\Models\Company\User;
use Bus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $company = factory(Company::class)->create();

        $user = factory(User::class)->raw();

        $this->user = $company->users()->create(
            array_merge($user, ['company_id' => $company->id])
        );

        $this->actingAs($this->user, 'users');
    }

    public function testCreateWrongData()
    {
        $supplier = [
            'name' => 'dasdasd',
        ];

        $response = $this->json('POST', 'api/companies/suppliers', $supplier);

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function testCreateSuccefull()
    {
        Bus::fake();

        $supplier = factory(Supplier::class)->raw();

        $response = $this->json('POST', 'api/companies/suppliers', $supplier);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['message', 'data']);

        $supplier = json_decode($response->getContent())->data;

        Bus::assertDispatched(SendEmailSupplier::class, function ($job) use ($supplier) {
            return $job->activation->supplier_id === $supplier->id;
        });
    }

    public function testDelete()
    {
        $supplier = factory(Supplier::class)->create();

        $response = $this->json('DELETE', 'api/companies/suppliers' . $supplier->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['message', 'data']);
    }
}
