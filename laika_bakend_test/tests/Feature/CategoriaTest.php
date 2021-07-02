<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_post()
    {
        $data = [
            'titulo' => 'name',
            'detalles' => 'description',
        ];

        $response = $this->withHeaders([
            'X-Header' =>  env('API_KEY_LAIKA'),
        ])->post('api/categories', $data
        );

        $response->assertStatus(201);
    }
    public function test_put()
    {
        $id = Category::all()->random()->id;
        $data = [
            'titulo' => 'name1'.$id,
            'detalles' => 'description',
        ];

        $response = $this->withHeaders([
            'X-Header' => env('API_KEY_LAIKA'),
        ])->put('api/categories/'.$id, $data
        );
        $response->assertStatus(200);
    }
}