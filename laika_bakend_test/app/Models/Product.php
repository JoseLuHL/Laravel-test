<?php

namespace App\Models;

use App\Models\Category;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Product extends Model
{
    use HasFactory, Notifiable;
    const PRODUCTO_DISPONIBLE=1;
    const PRODUCTO_NO_DISPONIBLE=0;
    
    public $transformer = ProductTransformer::class;

    protected $fillable=[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'category_id'
    ];

     public function estatusDisponible()
    {
       return  $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    public function setNameAttribute($valor)
    {
      $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor)
    {
     return ucfirst($valor);
    }

    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }

  //   protected $hidden = [
  //     'pivot',
  // ];

}
