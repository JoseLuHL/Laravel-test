<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Product $product)
    {
        
        return [
            'identificador' => (int)$product->id,
            'titulo' => (string)$product->name,
            'detalles' => (string)$product->description,
            'disponibles' => (string)$product->quantity,
            'estado' => (string)$product->status,
            'imagen'=> url("img/{$product->image}"),
            ''=> url("img/{$product->image}"),
            'categoria' => (string)$product->category_id,
            'fechaCreacion' => (string)$product->created_at,
            'links' => [
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),
                ]
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'titulo' => 'name',
            'detalles' => 'description',
            'disponibles' => 'quantity',
            'estado' => 'status',
            'imagen' => 'image',
            'categoria' => 'category_id',            
            'fechaCreacion' => 'created_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'titulo',
            'description' => 'detalles',
            'quantity' => 'disponibles',
            'status' => 'estado',
            'image' => 'imagen',
            'category_id' => 'categoria',  
            'created_at' => 'fechaCreacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}