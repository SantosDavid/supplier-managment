<?php

namespace Tests\Feature\Supplier;

use App\Jobs\SendEmailSupplier;
use App\Models\Admin\Company;
use App\Models\Tenant\Supplier;
use App\Models\Tenant\User;
use Bus;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $company;

    private $urlSuppliers;

    public function setUp()
    {
        parent::setUp();

        $this->company = factory(Company::class)->create();

        $this->urlSuppliers = "api/" . $this->company->id . "/suppliers/";

        $user = factory(User::class)->raw();

        $this->user = $this->company->users()->create(
            array_merge($user, ['company_id' => $this->company->id])
        );

        $this->actingAs($this->user, 'users');
    }

    public function testCreateWrongData()
    {
        $supplier = [
            'name' => 'dasdasd',
        ];

        $response = $this->json('POST', $this->urlSuppliers, $supplier);

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function testCreateSuccefull()
    {
        Bus::fake();

        $supplier = factory(Supplier::class)->raw();

        $response = $this->json('POST', $this->urlSuppliers, $supplier);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['message', 'data']);

        $supplier = json_decode($response->getContent())->data;

        Bus::assertDispatched(SendEmailSupplier::class, function ($job) use ($supplier) {
            return $job->activation->supplier_id === $supplier->id;
        });
    }

    public function testEditWrongData()
    {
        $supplier = factory(Supplier::class)->states('verified')->raw();

        $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

        DB::table('suppliers')->insert($supplier);

        $response = $this->json('PUT', $this->urlSuppliers . $supplier['id']);

        $response->assertStatus(422);
    }

    public function testEditSuccefull()
    {
        $supplier = factory(Supplier::class)->states('verified')->raw();

        $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

        DB::table('suppliers')->insert($supplier);

        $response = $this->json('PUT', $this->urlSuppliers . $supplier['id'], ['monthly_payment' => 320.20]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => ['monthly_payment' => 320.20],
            ]);
    }

    public function testDelete()
    {
        $supplier = factory(Supplier::class)->states('verified')->raw();

        $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

        DB::table('suppliers')->insert($supplier);

        $response = $this->json('DELETE', $this->urlSuppliers . $supplier['id']);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['message', 'data']);
    }

    public function testMonthlyPaymentReturnZero()
    {
        for ($i = rand(1, 3); $i < 16; $i++) {
            $data = factory(Supplier::class)->raw();

            $response = $this->json('POST', $this->urlSuppliers, $data);
        }

        $this->json('GET', $this->urlSuppliers . 'total-monthly-payment')
            ->assertStatus(200)
            ->assertJson([
                'data' => ['total' => 0.00],
            ]);
    }

    public function testMonthlyPayment()
    {
        $payment = 0.00;

        for ($i = rand(1, 3); $i < 16; $i++) {
            $supplier = factory(Supplier::class)->states('verified')->raw();

            $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

            DB::table('suppliers')->insert($supplier);

            $payment += $supplier['monthly_payment'];
        }

        $this->json('GET', $this->urlSuppliers . 'total-monthly-payment')
            ->assertStatus(200)
            ->assertJson([
                'data' => ['total' => bcdiv($payment, 1, 2)],
            ]);
    }
}
