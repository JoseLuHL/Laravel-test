<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class productoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post()
    {
        $id = Category::all()->random()->id;
        $data = [
            'titulo' => 'prieba1',
             'detalles' => 'prieba1',
             'disponibles' => 1,
             'estado' => 1,
             'imagen' =>'sdsd',
             'categoria'=>  $id
        ];
        $response = $this->withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->post('api/products', $data
        );
        $response->assertStatus(201);      
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_put()
    {
        $id = Category::all()->random()->id;
        $producto_id= Product::all()->random()->id;
        $data = [
             'titulo' => 'prueba 1',
             'detalles' => 'prueba 1',
             'disponibles' => 1,
             'estado' => Product::PRODUCTO_DISPONIBLE,
             'imagen' => 'asas',
             'categoria'=>  $id
        ];

        $response = $this->withHeaders([
            'X-Header' => env('API_KEY_LAIKA'),
        ])->put('api/products/'.$producto_id, $data
        );
        $response->assertStatus(200);
    }

}
