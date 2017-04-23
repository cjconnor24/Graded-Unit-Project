<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('branch_id')->unsigned();

            $table->decimal('discount');
            $table->enum('state',['quotation','order','invoice']);
            $table->enum('status',['Awaiting Approval','Design','Print','Finishing','Complete']);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('branch_id')->references('id')->on('branches');

        });

        Schema::create('order_product', function (Blueprint $table) {

            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('price')->nullable();
            $table->integer('qty');
            $table->text('description')->nullable();

            $table->primary(['product_id','order_id']);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
