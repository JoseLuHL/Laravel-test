<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'identificador'=>(int)$category->id,
            'titulo'=> (string)$category->name,
            'detalles'=> (string)$category->description,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('categories.show',$category->id),
                ],
                [
                    'rel'=>'category.products',
                    'href'=>route('categories.products.index',$category->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            
            'identificador' => 'id',
            'titulo' => 'name',
            'detalles' => 'description',
           
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'titulo',
            'description' => 'detalles',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
