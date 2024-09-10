<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function test_get_no_advertisement(): void
    {
        $response = $this->getJson('/api/advertisement/9999/');

        $response->assertStatus(404);
    }

    public function test_get_no_advertisement_collection():void
    {
        $response = $this->getJson('/api/advertisement');

        $response->assertStatus(404);
    }

    public function test_get_advertisement(): void
    {
        Advertisement::factory(100)->create();
        $response = $this->getJson('/api/advertisement/1/');

        $response->assertStatus(200);
    }

    public function test_get_advertisement_collection():void
    {
        Advertisement::factory(100)->create();
        $response = $this->getJson('/api/advertisement');

        $response->assertStatus(200);
    }

    public function test_post_advertisement():void
    {
        $response = $this->postJson('/api/advertisement', ['title' => 'Sally', 'description' =>'description', 'price' => 0.01]);
        $response->assertStatus(200)
            ->assertJson(['id' => 201]);
    }

}
