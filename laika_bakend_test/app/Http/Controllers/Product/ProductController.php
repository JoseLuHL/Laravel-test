<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiComtroller;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\BinaryOp\Mod;

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
        $response = DB::select('CALL sp_get_productos()');
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
        $rules=[
            'name'=>'required',
            'description'=>'required',
            'quantity'=> 'required|numeric',
            'status'=>'required|numeric|min:0|max:1',
            'category_id'=>'required|numeric',
        ];
        $this->validate($request,$rules);
        $name = $request->input('name');
        $description = $request->input('description');
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $image = $request->input('image');
        $categoria_id = $request->input('category_id');        
        $response = DB::insert('CALL sp_insert_products(?,?,?,?,?,?)', array($name, $description, $quantity, $status, $image,$categoria_id));
        if ($response) {
            return  $this->errorResponse("Producto creado correctamente",201);
        }
        else{
            return  $this->errorResponse("Error al crear el producto",404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $response = (DB::select(' CALL sp_get_one_product(?)',array($id)));
        return ($this->showOnee($response));
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
        $rules=[
            'name'=>'required',
            'description'=>'required',
            'quantity'=> 'required|numeric',
            'status'=>'required|numeric|between:0,1',
            'category_id'=>'required|numeric',
        ];
        $this->validate($request,$rules);

        $name = $request->input('name');
        $description = $request->input('description');
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $image = $request->input('image');
        $categoria_id = $request->input('category_id');
         $response = DB::update('CALL sp_update_product(?,?,?,?,?,?,?)', [$id, $name,$description,$quantity,$status,$image,$categoria_id]);
         if ($response) {
            return  $this->errorResponse("Producto actualizado correctamente",200);
        }
        else{
            return  $this->errorResponse("Error al actualizar el producto",404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::delete('CALL sp_delete_product(?)', [$id]);
    }
}
