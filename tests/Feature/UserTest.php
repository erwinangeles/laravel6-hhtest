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
        $this->assertEquals(1, User::where('email', '=', 'erwin@example.com')->count());

        //Attempt to login using the email and password of the recently created user
        $response = $this->post('/login', [
            'email' => 'erwin@example.com',
            'password' => 'Password123'
        ])->assertRedirect('/user/profile');

        //Check that user logged in status is true after posting login
        $this->assertTrue(Auth::check());
    }

}
