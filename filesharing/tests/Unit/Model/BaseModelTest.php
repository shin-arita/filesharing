<?php

namespace Tests\Unit\Model;

use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BaseModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_custom_uuid_field_is_set_correctly(): void
    {
        $group = Group::factory()->create();

        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@example.com';
        $user->password = 'password';
        $user->role = Role::GENERAL_USER;
        $user->group_id = $group->id;
        $user->save();

        $this->assertNotNull($user->id);
        $this->assertTrue(Str::isUuid($user->id));
    }
}
