<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\RefreshDatabase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();

        factory(\App\UserType::class)->create(['user_id' => $user->id]);


        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
