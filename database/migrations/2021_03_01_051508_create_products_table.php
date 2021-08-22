<?php

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
            $table->id();
            $table->integer('category_id');
            $table->integer('tag_id');
            $table->integer('product_type_id')->nullable();
            $table->string('product_name');
            $table->float('product_price');
            $table->integer('product_quantity');
            $table->integer('alert_quantity');
            $table->longText('product_short_description');
            $table->longText('product_long_description');
            $table->string('product_thumbnail_photo')->default('default_product_thumbnail_photo.jpg');
            $table->longText('slug');
            $table->text('product_SKU');
            $table->timestamps();
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
