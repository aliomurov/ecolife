<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('categoryproduct_id')->unsigned()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('kod')->unique()->nullable();
            $table->integer('price')->nullable();
            $table->integer('old_price')->nullable();
            $table->integer('gram')->nullable();
            $table->string('image')->unique()->nullable();
            $table->text('description')->nullable();
            $table->text('structure')->nullable();
            $table->text('preparation')->nullable();
            $table->boolean('new')->default(false)->nullable();
            $table->boolean('sale')->default(false)->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->boolean('available')->default(false)->nullable();

            $table->timestamps();

            $table->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->foreign('categoryproduct_id')
                ->references('id')
                ->on('categoryproducts')
                ->onDelete('cascade');
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
