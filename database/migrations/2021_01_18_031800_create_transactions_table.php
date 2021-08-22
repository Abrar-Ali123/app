<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unique();

            $table->unsignedBigInteger('order_payment_id');
            $table->boolean('captured')->default(false);
            $table->boolean('refunded')->default(false);
            $table->boolean('success')->default(true);

            $table->double('admin_revenue');

            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('delivery_boy_id')->nullable();

            $table->double('admin_to_shop')->default(0);
            $table->double('admin_to_delivery_boy')->default(0);

            $table->double('shop_to_admin')->default(0);

            $table->double('delivery_boy_to_admin')->default(0);


            $table->double('total');


            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('order_payment_id')->references('id')->on('order_payments');
            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('transactions');
    }
}
