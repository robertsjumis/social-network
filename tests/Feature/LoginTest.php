<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteExists()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testInvalidLogin(): void
    {
        $this->followingRedirects()
            ->from("/login")
            ->post('/login', [])
            ->assertOk()
            ->assertSeeText("The email field is required.")
            ->assertSeeText("The password field is required.");
    }

    public function testInvalidCredentials()
    {
        $this->followingRedirects()
            ->from("/login")
            ->post('/login', [
                "email" => "test@test.com",
                "password" => "1234"
            ])
            ->assertStatus(200)
            ->assertSeeText("These credentials do not match our records.");
    }

    public function testLogin()
    {
        $password = "password";

        $user = factory(User::class)->create([
            "password" => bcrypt($password)
        ]);

        $this->followingRedirects()
            ->from("/login")
            ->post('/login', [
                "email" => $user->email,
                "password" => $password
            ])
            ->assertStatus(200);

        $this->assertTrue(auth()->check());
    }

    public function testLoginWhenLoggedIn()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/login');
        $response->assertStatus(302);

    }

}
