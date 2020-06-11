<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('orders', function (Blueprint $table) {
             $table->bigInteger('payment_id')->unsigned();
             $table->bigInteger('delivery_id')->unsigned();
         });

         Schema::table('orders', function (Blueprint $table) {
             $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
             $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
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
