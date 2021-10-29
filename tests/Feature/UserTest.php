<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\UserRepository;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $userRepository;
    public function test_create_user()
    {
        $input = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation'=> 'password'
        ];
       

       // $response = $this->postJson('api/auth/register', $input);
       $this->json('POST', 'api/auth/register', $input, ['Accept' => 'application/json'])
            ->assertStatus(200);

       
    }
    public function testSuccessfulLogin()
    {
        $input = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation'=> 'password'
        ];
        $this->json('POST', 'api/auth/register', $input, ['Accept' => 'application/json']);

        $loginData = ['email' =>   $input['email'], 'password' => 'password'];

        $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $this->assertAuthenticated();
    }
}
