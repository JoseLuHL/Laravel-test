<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\UseUse;
use App\Models\Product;
use App\Transformers\CategoryTransformer;

class Category extends Model
{
    use HasFactory;
    public $transformer = CategoryTransformer::class;
    protected $fillable =  [
        'name',
        'description',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];
}
