<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_a_category()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/categories', [
            'name' => 'Work',
        ])->assertStatus(201)
          ->assertJson([
              'name' => 'Work',
          ]);
    }

    /** @test */
    
}