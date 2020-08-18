<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_products', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->string('image')->nullable();
            $table->float('price')->nullable();
            $table->char('url_ml')->nullable();
            $table->char('url_am')->nullable();
            $table->char('url_ms')->nullable();
            $table->foreignId('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('info_products');
    }
}
