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
        //Simiulating a user being created
        User::create([
            'name' => 'Erwin Angeles',
            'email' => 'erwin@example.com',
            'password' => bcrypt('Password123')
        ]);

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

    public function test_user_updates_details_on_profile(){
        //uses dummy user to update
        $this->actingAs($user = factory(User::class)->create())->post('/user/update', [
            'name' => 'Sally Sue',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'email' => 'updated@example.com'
        ])->assertOk();

        //verifying user was updated
        $this->assertTrue(User::where('email', '=', 'updated@example.com')->exists());

    }

}
