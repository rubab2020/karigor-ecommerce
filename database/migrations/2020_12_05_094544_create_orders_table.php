<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->comment('USER ID');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->bigInteger('cart_id')->unsigned()->index()->nullable()->comment('USER ID');
            $table->foreign('cart_id')->on('carts')->references('id')->onDelete('cascade');
            $table->decimal('grand_total', 10, 2)->nullable()->comment('GRAND TOTAL');
            $table->decimal('subtotal', 10, 2)->nullable()->comment('SUBTOTAL WITHOUT DISCOUNT');
            $table->decimal('subtotal_with_discount', 10, 2)->nullable()->comment('SUBTOTAL_WITH_DISCOUNT');
            $table->decimal('subtotal_with_coupon', 10, 2)->nullable()->comment('SUBTOTAL_WITH_COUPON');
            $table->string('coupon_code', 100)->nullable()->comment('COUPON CODE');
            $table->text('customer_note')->nullable()->comment('CUSTOMER NOTE');
            $table->decimal('delivery_charge', 10, 2)->nullable()->comment('DELIVERY_CHARGE');
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
        Schema::dropIfExists('orders');
    }
}
