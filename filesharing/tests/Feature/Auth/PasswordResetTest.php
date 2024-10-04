<?php

namespace Tests\Feature\Auth;

use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Group $group;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $this->post('/forgot-password', ['email' => $this->user->email]);

        Notification::assertSentTo($this->user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $this->post('/forgot-password', ['email' => $this->user->email]);

        Notification::assertSentTo($this->user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $this->post('/forgot-password', ['email' => $this->user->email]);

        Notification::assertSentTo($this->user, ResetPassword::class, function ($notification) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $this->user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }
}
