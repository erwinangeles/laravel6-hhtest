<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use App\User;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_unathorized_api_get_request(){
        $this->actingAs($user = factory(User::class)->create());

        //attemp GET request with no API Key
        $response = $this->get('/api/users?api_key=' . null);
        $response->assertStatus(401);
    }

    public function test_unathorized_api_post_request_with_data(){
        $this->actingAs($user = factory(User::class)->create());
        
        //attempt POST request with no api key
        $response = $this->post('/api/users?api_key=' . null, [
            'name' => 'Johnny Testing',
            'country' => 'Canada'
        ])->assertStatus(401);

    }

    public function test_successful_api_get_request()
    {
        $this->actingAs($user = factory(User::class)->create());

        //sets default attributes;
        $user->setAttributes();
        //creates api key for newly created user
        $key = $user->generateKey();
        
        //GET request to pull user data
        $response = $this->get('/api/users?api_key=' . $key);

        $response->assertStatus(201);
    }

    public function test_successful_api_post_request_with_data()
    {
        $user = factory(User::class)->create();
        //sets default attributes;
        $user->setAttributes();

        //creates api key to use
        $key = $user->generateKey();
        
        //POST request with form data
        $response = $this->post('/api/users?api_key=' . $key, [
            'name' => 'Sally Sue',
            'country' => 'USA'
        ])->assertStatus(201);
        
        //verifies updates to user attributes were made
        $this->assertEquals(User::find($user->id)->name, 'Sally Sue');
        $this->assertEquals(User::find($user->id)->attributes->country, 'USA');
    }
}
