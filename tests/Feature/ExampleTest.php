<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $input=[];
        $this->json('POST', 'api/auth/register', $input, ['Accept' => 'application/json'])
        ->assertStatus(422);
    }
    
}
