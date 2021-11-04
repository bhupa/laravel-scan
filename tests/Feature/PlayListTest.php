<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class PlayListTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPlayList()
    {
        $data =[
            'title'=>$this->faker->name,
            'type'=>'link',
            'value'=>$this->faker->url,
            'status'=>1
        ];
        $this->json('POST', 'api/play-list', $data, ['Accept' => 'application/json'])
        ->assertStatus(200);
       

    }
    protected function setUp(): void
    {
        parent::setUp();
        $user =  User::latest()->first();
        $this->user = $user;
        Sanctum::actingAs($user);
    }
}
