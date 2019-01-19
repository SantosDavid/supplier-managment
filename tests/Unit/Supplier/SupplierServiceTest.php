<?php

namespace Tests\Unit\Supplier;

use App\Repositories\Supplier\SupplierRepository;
use App\Services\Supplier\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class SupplierServiceTest extends TestCase
{
    use RefreshDatabase;

    private $repositoryMock;

    public function testgetTotalMonthlyPayment()
    {
        $this->repositoryMock = Mockery::mock(SupplierRepository::class);

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
