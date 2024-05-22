<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->withSession(['banned' => false])
        ->get('/account');

        $response->assertStatus(200);
        $this->actingAs($user, 'web');

        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        $username = fake()->userName();
        $phone = '0123456789';
        $email = fake()->unique()->safeEmail();
        $city = fake()->city();
        $post_code = '14000';
        $street_number = fake()->numberBetween(5,10);
        $street_name = fake()->streetName();

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'city' => $city,
            'post_code' => $post_code,
            'street_number' => $street_number,
            'street_name' => $street_name,
        ];

        $response = $this->post(route('modifyAccount'), $data);

        $response->assertStatus(200);
    }

}
