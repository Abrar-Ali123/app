<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_item_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->integer('quantity');
            $table->boolean('active')->default(true);

            $table->string('p_name')->nullable();
            $table->longText('p_description')->nullable();
            $table->double('p_price')->nullable();
            $table->double('p_revenue')->nullable();
            $table->integer('p_offer')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_item_id')->references('id')->on('product_items');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('carts');
    }
}
