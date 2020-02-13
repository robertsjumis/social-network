<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testLogout(): void
    {

        $user = factory(User::class)->make();

        $this->actingAs($user);

        $this->followingRedirects()
            ->from("/home")
            ->post("/logout")
            ->assertOk();

        $this->assertFalse(auth()->check());

        //TODO: notesteet forgot un reset password

    }

}
