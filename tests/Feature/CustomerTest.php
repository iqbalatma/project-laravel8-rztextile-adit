<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route("customers.index"));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas("title", "Customer");
        $response->assertViewHas("cardTitle", "Customers");
        $response->assertViewHas("customers");

        $customers = $response->original->getData()["customers"];

        $this->assertInstanceOf(LengthAwarePaginator::class, $customers);
    }
}
