<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('stock');
            $table->integer('supplier_id');
            $table->string('address')->default('Cantilan, SDS');
            $table->string('code')->default('CO');
            $table->string('remarks')->default('supplier');
            $table->string('inventory_evaluation_method')->default('FIFO');
            $table->string('total_weight_volume')->default('N/A');
            $table->float('unit_price');
            $table->string('unit');
            $table->string('posted_by');
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
        Schema::dropIfExists('items');
    }
}
