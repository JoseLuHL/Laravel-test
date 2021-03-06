<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiComtroller;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends ApiComtroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
       return $this->showAll($category->products);

    }

}
