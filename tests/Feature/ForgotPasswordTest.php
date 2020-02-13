<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailer;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
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
            ->post('/password/reset', [])
            ->assertOk()
            ->assertSeeText("The email field is required.");

    }

    public function testInvalidEmailInput(): void
    {
        $this->followingRedirects()
            ->from("/password/reset")
            ->post('/password/reset', [
                "email" => "test"
            ])
            ->assertStatus(200)
            ->assertSeeText("The email must be a valid email address.");

        $this->from("/password/reset")
            ->post("/password/reset", [
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
            ->assertSeeText("We can&#039;t find a user with that e-mail address");
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

    public function testEmailSent()
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

        Mail::fake();

//         Assert a message was sent to the given users...
        Mail::assertSent(RecoverPasswordNotification::class);

    }


}

