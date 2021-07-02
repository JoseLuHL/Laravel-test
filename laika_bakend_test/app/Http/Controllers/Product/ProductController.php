<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiComtroller;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiComtroller
{
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('signature',);
        $this->middleware('transform.input:' . ProductTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pro = Product::select('CALL laika_bakend_test.sp_obtener_productos()');
        $response = DB::select('CALL laika_bakend_test.sp_obtener_productos()');
        $data = collect($response)->values();
        return $this->showAlll($data, 200);
        // return $this->showAll(Product::all(),200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelo = new Product();
        //
        // $name = $request->input('name');
        // $description = $request->input('description');
        // $quantity = $request->input('quantity');
        // $status = $request->input('status');
        // $image = $request->input('image');
        // $response = DB::insert('CALL laika_bakend_test.sp_insert_products(?,?,?,?,?)', array($name, $description, $quantity, $status, $image));
        return  $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = DB::select('CALL laika_bakend_test.sp_obtener_productos()');
        return $this->showAll(collect($response));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
