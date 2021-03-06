<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'categories';

    protected $fillable = ['name','description'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryProducts()
    {
        return $this->hasMany('App\Models\CategoryProduct', 'category_id', 'id');
    }
    
}
