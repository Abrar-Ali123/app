<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address');
            $table->string('image_url');
            $table->double('rating')->default(0);
            $table->integer('delivery_range');
            $table->integer('total_rating')->default(0);
            $table->integer('default_tax')->default(0);
            $table->integer('admin_commission')->default(0);
            $table->boolean('available_for_delivery')->default(false);
            $table->boolean('open')->default(false);
            $table->double('minimum_delivery_charge')->default(0);
            $table->double('delivery_cost_multiplier')->default(0);
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('managers');
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
        Schema::dropIfExists('shops');
    }
}
