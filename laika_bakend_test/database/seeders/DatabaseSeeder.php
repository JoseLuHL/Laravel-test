<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');        
        Category::truncate();
        Product::truncate(); 

        $cantidadCategoria=5;
        $cantidadProductos=8;

        Category::factory($cantidadCategoria)->create();
       Product::factory($cantidadProductos)->create();
        //     function($producto){
        //         $categorias = Category::all()->random(mt_rand(1,5))->pluck('id');
        //         $producto -> categories()->attach($categorias);
        //     }
        // );
    }
}
