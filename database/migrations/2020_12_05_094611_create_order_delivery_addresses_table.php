<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->index()->unsigned()->comment('ORDER ID');
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade');
            $table->string('name', 255);
            $table->text('address');
            $table->text('appartment')->nullable();
            $table->string('city', 255);
            $table->string('district', 255);
            $table->string('zipcode', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone');
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
        Schema::dropIfExists('order_delivery_addresses');
    }
}
