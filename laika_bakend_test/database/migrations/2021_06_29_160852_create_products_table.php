<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->string('description',1000)->nullable();
            $table->integer('quantity')->unsigned();
            $table->boolean('status')->default(Product::PRODUCTO_DISPONIBLE);
            $table->string('image')->nullable();
            $table->integer('category_id')->unsigned();
            $table->timestamps();
            $table->index('status');
            $table->foreign('category_id')->references('id')->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
