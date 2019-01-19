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

    private $endpointSuppliers;

    public function setUp()
    {
        parent::setUp();


        $this->company = factory(Company::class)->create();

        $this->user = $this->company->users()->create(
            array_merge(
                factory(User::class)->raw(),
                ['company_id' => $this->company->id]
            )
        );

        
        $this->actingAs($this->user, 'users');


        $this->endpointSuppliers = "api/" . $this->company->id . "/suppliers/";
    }

    public function testCreateWrongData()
    {
        $supplier = ['name' => 'dasdasd'];


        $response = $this->json('POST', $this->endpointSuppliers, $supplier);


        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function testCreateSuccefull()
    {
        Bus::fake();

        $supplier = factory(Supplier::class)->raw();


        $response = $this->json('POST', $this->endpointSuppliers, $supplier);


        $response
            ->assertStatus(201)
            ->assertJsonStructure(['message', 'data']);
    }

    public function testSendEmailDispatched()
    {
        Bus::fake();

        $response = $this->json(
            'POST',
            $this->endpointSuppliers,
            factory(Supplier::class)->raw()
        );

        $supplier = json_decode($response->content())->data;


        Bus::assertDispatched(SendEmailSupplier::class, function ($job) use ($supplier) {
            return $job->activation->supplier_id === $supplier->id;
        });
    }

    public function testEditWrongData()
    {
        $supplier = factory(Supplier::class)->states('verified')->raw();

        $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

        DB::table('suppliers')->insert($supplier);


        $response = $this->json('PUT', $this->endpointSuppliers . $supplier['id']);


        $response->assertStatus(422);
    }

    public function testEditSuccefull()
    {
        $supplier = factory(Supplier::class)->states('verified')->raw();

        $supplier = array_merge($supplier, ['company_id' => $this->company->id]);

        DB::table('suppliers')->insert($supplier);


        $response = $this->json('PUT', $this->endpointSuppliers . $supplier['id'], ['monthly_payment' => 320.20]);


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


        $response = $this->json('DELETE', $this->endpointSuppliers . $supplier['id']);


        $response
            ->assertStatus(200)
            ->assertJsonStructure(['message', 'data']);
    }

    public function testMonthlyPaymentReturnZero()
    {
        for ($i = rand(1, 3); $i < 16; $i++) {
            $this->json(
                'POST',
                $this->endpointSuppliers,
                factory(Supplier::class)->raw()
            );
        }


        $reponse = $this->json('GET', $this->endpointSuppliers . 'total-monthly-payment');
            
        
        $reponse->assertStatus(200)
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


        $response = $this->json('GET', $this->endpointSuppliers . 'total-monthly-payment');
        
        
        $response->assertStatus(200)
            ->assertJson([
                'data' => ['total' => bcdiv($payment, 1, 2)],
            ]);
    }
}
