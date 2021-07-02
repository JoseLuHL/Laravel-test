<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = ['name','description','quantity','status','image','category_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryProducts()
    {
        return $this->hasMany('App\Models\CategoryProduct', 'product_id', 'id');
    }
    
}
