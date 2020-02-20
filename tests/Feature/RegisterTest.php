<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteExists(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testRegisterWhenLoggedIn()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/register');
        $response->assertStatus(302);
    }

    public function testEmptyInput(): void
    {
        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [])
            ->assertOk()
            ->assertSeeText("The email field is required.")
            ->assertSeeText("The last name field is required.")
            ->assertSeeText("The password field is required.")
            ->assertSeeText("The name field is required.");
    }

    public function testInvalidEmailInput(): void
    {
        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "email" => "test",
                "password" => "1234"
            ])
            ->assertStatus(200)
            ->assertSeeText("The email must be a valid email address.");

        $this->from("/register")
            ->post("/register", [
                "email" => "invalid"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email" => "The email must be a valid email address."
            ]);
    }

    public function testPasswordTooShort(): void
    {
        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "email" => "test@test.com",
                "password" => "1234"
            ])
            ->assertStatus(200)
            ->assertSeeText("The password must be at least 8 characters.");
    }

    public function testPasswordDoesNotMatch(): void
    {
        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "name" => "rob",
                "lastName" => "rob",
                "email" => "test@test.com",
                "password" => "12345678",
                "password_confirmation" => "1234567"
            ])
            ->assertStatus(200)
            ->assertSeeText("The password confirmation does not match.");
    }

    public function testEmailAlreadyInUse(): void
    {
        $user = factory(User::class)->create();

        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "name" => "rob",
                "lastName" => "rob",
                "email" => $user->email,
                "password" => "12345678",
                "password_confirmation" => "12345678"
            ])
            ->assertStatus(200)
            ->assertSeeText("The email has already been taken.");
    }

    public function testRegister(): void
    {
        $user = factory(User::class)->make();

        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "name" => $user->name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "address" => $user->address,
                "password" => "12345678",
                "password_confirmation" => "12345678"
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas("users", [
            "email" => $user->email,
            "name" => $user->name
        ]);

        $this->assertTrue(auth()->check());

    }

}
