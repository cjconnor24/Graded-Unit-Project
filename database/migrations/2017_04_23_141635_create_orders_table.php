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
            $table->integer('address_id')->unsigned();

            $table->integer('staff_id')->unsigned();
            $table->integer('branch_id')->unsigned();

            $table->integer('state_id')->unsigned();
            $table->integer('status_id')->unsigned()->nullable();

            $table->decimal('discount');

            $table->date('due_date')->nullable();

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('status_id')->references('id')->on('order_statuses');

            // MAKE ORDERS START FROM 100,000 FOR READABILITY REASONS
//            DB::update("ALTER TABLE orders AUTO_INCREMENT = 100000;");

        });

        Schema::create('order_product', function (Blueprint $table) {

            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();

            /**
             * CHOSEN OPTIONS FOR PARTICULAR PRODUCT / ORDER
             */
            $table->integer('paper_id')->unsigned();
            $table->integer('size_id')->unsigned();


            // $table->integer('price')->nullable();
            $table->integer('qty');
            $table->text('description')->nullable();

            $table->primary(['product_id','order_id','paper_id','size_id']);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('paper_id')->references('id')->on('papers');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

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
