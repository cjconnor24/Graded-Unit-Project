<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('manufacturer');
            $table->integer('weight');
            $table->timestamps();
        });

        Schema::create('paper_product', function (Blueprint $table) {

            $table->integer('paper_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->primary(['paper_id','product_id']);

            $table->foreign('paper_id')->references('id')->on('papers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papers');
        Schema::dropIfExists('paper_product');
    }
}
