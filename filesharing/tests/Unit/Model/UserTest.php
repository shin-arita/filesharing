<?php

namespace Tests\Unit\Model;

use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_uuid_is_generated_on_creation(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertTrue(Str::isUuid($user->id));
    }

    public function test_password_is_hashed_on_creation(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => Role::GENERAL_USER,
            'group_id' => Group::factory()->create()->id,
        ]);

        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function test_user_belongs_to_group(): void
    {
        $group = Group::factory()->create();
        $user = User::factory()->create(['group_id' => $group->id]);

        $this->assertInstanceOf(Group::class, $user->group);
        $this->assertEquals($group->id, $user->group->id);
    }
}
