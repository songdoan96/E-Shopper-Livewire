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
            // order_id	customer_id	shipping_id	order_status	order_code	order_date	order_destroy
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipping_id');
            $table->string('cart_subtotal');
            $table->string('subtotal');
            $table->string('discount');
            $table->string('tax');
            $table->string('total');
            $table->string('coupon_code');
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default("ordered");
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('canceled_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
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
