<?php

namespace Tests\Feature;

use App\User;
use Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_new_user_creates_account_and_logs_in()
    {
        //a user being created through register page
        $this->post('/register', [
            'name' => 'Erwin Angeles',
            'email' => 'erwin@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123'
        ])->assertRedirect('/login');

        //Verifying user was created
        $this->assertTrue(User::where('email', '=', 'erwin@example.com')->exists());


        //Attempt to login using the email and password of the recently created user
        $response = $this->post('/login', [
            'email' => 'erwin@example.com',
            'password' => 'Password123'
        ])->assertRedirect('/user/profile');

        //Check that user logged in status is true after posting login
        $this->assertTrue(Auth::check());
    }

    public function test_only_logged_in_users_can_see_profile_page(){
        //verify user is redirected if not logged in
        $response = $this->get('/user/profile')->assertRedirect('login');
    }

    public function test_authenticated_users_can_see_profile_page(){
        //creates dummy user to use profile
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/user/profile')->assertOk();
    }

    public function test_user_updates_attributes_on_profile_page(){
        //user updates attributes through profile page
        $this->actingAs($user = factory(User::class)->create())->post('/user/update', [
            'name' => 'Sally Sue',
            'email' => 'updated@example.com',
            'birthday' => '1990-12-01',
            'country' => 'New Zeland',
        ]);

        //verifying user was updated
        $this->assertEquals($user->name, 'Sally Sue');
        $this->assertEquals($user->email, 'updated@example.com');
        $this->assertEquals($user->attributes()->birthday, '1990-12-01');
        $this->assertEquals($user->attributes()->country, 'New Zeland');

    }

    public function test_user_creating_api_key_on_profile_page(){
        //creates dummy user to use profile
        $this->actingAs($user = factory(User::class)->create())->post('user/apiKey/create');

        //verifies a key was created for the user
        $this->assertEquals(1, $user->apiKeys()->count());
    }

}
