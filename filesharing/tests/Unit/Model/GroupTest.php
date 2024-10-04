<?php

namespace Tests\Unit\Model;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_uuid_is_generated_on_creation(): void
    {
        $group = Group::factory()->create();

        $this->assertNotNull($group->id);
        $this->assertTrue(Str::isUuid($group->id));
    }

    public function it_can_create_a_group_with_users(): void
    {
        $group = Group::factory()->create();

        $user = User::factory()->create([
            'group_id' => $group->id,
        ]);

        $this->assertCount(1, $group->users);
        $this->assertTrue($group->users->contains($user));
    }

    public function it_can_retrieve_users_belonging_to_a_group(): void
    {
        $group = Group::factory()->create();

        $user1 = User::factory()->create(['group_id' => $group->id]);
        $user2 = User::factory()->create(['group_id' => $group->id]);

        $users = $group->users;

        $this->assertCount(2, $users);
        $this->assertTrue($users->contains($user1));
        $this->assertTrue($users->contains($user2));
    }
}
