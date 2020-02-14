<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailer;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Mockery\Mock;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteExists(): void
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
    }

    public function testInvalidLogin(): void
    {
        $this->followingRedirects()
            ->from("/password/reset")
            ->post('/password/email', [])
            ->assertOk()
            ->assertSeeText("The email field is required.");
    }

    public function testEmptyLogin(): void
    {
        $this->from("/password/reset")
            ->post('/password/email', [])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email" => "The email field is required."
            ]);
    }

    public function testInvalidEmailInput(): void
    {
        $this->followingRedirects()
            ->from("/password/reset")
            ->post('/password/email', [
                "email" => "test"
            ])
            ->assertStatus(200)
            ->assertSeeText("The email must be a valid email address.");

        $this->from("/password/reset")
            ->post("/password/email", [
                "email" => "invalid"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email" => "The email must be a valid email address."
            ]);
    }

    public function testInvalidCredentials(): void
    {
        $this->followingRedirects()
            ->from("/password/reset")
            ->post('/password/email', [
                "email" => "roberts@test.com"
            ])
            ->assertStatus(200)
            ->assertSeeText('We can&#039;t find a user with that e-mail address.');
    }

    public function testCreatePasswordResetLink(): void
    {
        $user = factory(User::class)->create([
            "email" => "rob@rob.lv"
        ]);

        $this->followingRedirects()
            ->from("/password/reset")
            ->post('/password/email', [
                "email" => "rob@rob.lv"
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas("password_resets", [
            "email" => $user->email
        ]);

    }

    public function testForgotPassword(): void
    {
        Notification::fake();

        $user = factory(User::class)->create([
            "email" => "rob@rob.lv"
        ]);

        $this->followingRedirects()
            ->from("password/reset")
            ->post("password/email", [
                "email" => $user->email
            ])
            ->assertOk()
            ->assertSeeText("We have e-mailed your password reset link!");

        $this->assertDatabaseHas("password_resets", [
            "email" => $user->email
        ]);

        Notification::assertSentTo([$user],ResetPassword::class);
    }


}

