<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Mockery\Mock;
use Tests\TestCase;

class VerificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSendEmail(): void
    {
        Notification::fake();

        $user = factory(User::class)->make();

        $this->followingRedirects()
            ->from("/register")
            ->post('/register', [
                "name" => $user->name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "password" => "12345678",
                "password_confirmation" => "12345678"
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas("users", [
            "email" => $user->email,
            "name" => $user->name
        ]);
        //Notification::shouldReceive('send')->once();
       //Notification::assertSentTo([$user], VerifyEmail::class);
    }

    public function testEmailVerification(): void
    {
        $user = factory(User::class)->create([
            "email_verified_at" => null
        ]);

        $hash = sha1($user->email);
        $expires = now()->addMinutes(15);

        $this->followingRedirects()
            ->from("/home")
            ->get(route("verification.verify", [
                "id" =>$user->id,
                "hash" => $hash
            ]))
            ->assertOk();

        $user->refresh();

        $this->assertDatabaseHas("users", [
            "email" => $user->email,
            "email_verified_at" => $user->email_verified_at
        ]);

    }

}
