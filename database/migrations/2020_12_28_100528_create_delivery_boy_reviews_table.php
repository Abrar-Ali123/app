<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryBoyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_reviews', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rating');
            $table->text('review')->nullable();


            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('delivery_boy_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('delivery_boy_id')->references('id')->on('delivery_boys');

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
        Schema::dropIfExists('delivery_boy_reviews');
    }
}
