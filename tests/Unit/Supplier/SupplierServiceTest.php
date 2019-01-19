<?php

namespace Tests\Unit\Supplier;

use App\Services\Supplier\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
use App\Repositories\Supplier\SupplierRepository;

class SupplierServiceTest extends TestCase
{
    use RefreshDatabase;

    private $repositoryMock;

    public function setUp()
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(SupplierRepository::class);
    }

    public function testgetTotalMonthlyPayment()
    {
        $payment = collect(random_array_float());

        $this
            ->repositoryMock
            ->shouldReceive('allMonthlyPayment')
            ->once()
            ->andReturn($payment);

        $service = new SupplierService($this->repositoryMock);

        $total = $service->getTotalMonthlyPayment();

        $this->assertEquals($payment->sum(), $total);
    }
}
