<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('roles.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewHas("title", "Role")
            ->assertViewHas("cardTitle", "Roles")
            ->assertViewHas("roles");
        
        $roles = $response->original->getData()["roles"];

        $this->assertInstanceOf(LengthAwarePaginator::class, $roles);
    }
}
