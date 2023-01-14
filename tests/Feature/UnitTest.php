<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class UnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route("units.index"));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas("title", "Unit");
        $response->assertViewHas("cardTitle", "Units");
        $response->assertViewHas("units");

        $units = $response->original->getData()['units'];
        
        $this->assertInstanceOf(LengthAwarePaginator::class, $units);
    }
}
