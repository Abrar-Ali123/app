<?php

use App\Models\UserAddress;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->decimal('longitude',10,7);
            $table->decimal('latitude',10,7);
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->boolean('default')->default(false);
            $table->integer('pincode');
            $table->boolean('active')->default(true);
            $table->integer('type')->default(UserAddress::$OTHER);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_addresses');
    }
}
