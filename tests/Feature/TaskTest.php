<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_a_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'pending',
            'due_date' => '22-01-2025',
        ]);

        $response->assertStatus(201);
    }
}
