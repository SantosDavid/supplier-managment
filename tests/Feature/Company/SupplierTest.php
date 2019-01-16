<?php

namespace Tests\Feature\Company;

use App\Jobs\SendEmailSupplier;
use App\Models\Company\Company;
use App\Models\Company\Supplier;
use App\Models\Company\User;
use Bus;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $company;

    public function setUp()
    {
        parent::setUp();

        $this->company = factory(Company::class)->create();

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
        $supplier = factory(Supplier::class)->raw();

        $response = $this->json('POST', 'api/companies/suppliers', $supplier);

        $supplier = json_decode($response->getContent())->data;

        $response = $this->json('DELETE', 'api/companies/suppliers/' . $supplier->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['message', 'data']);
    }

    public function testMonthlyPaymentReturnZero()
    {
        for ($i = rand(1, 3); $i < 16; $i++) {
            $data = factory(Supplier::class)->raw();

            $response = $this->json('POST', 'api/companies/suppliers', $data);
        }

        $this->json('GET', 'api/companies/suppliers/total-monthly-payment')
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

        $this->json('GET', 'api/companies/suppliers/total-monthly-payment')
            ->assertStatus(200)
            ->assertJson([
                'data' => ['total' => bcdiv($payment, 1, 2)],
            ]);
    }
}
