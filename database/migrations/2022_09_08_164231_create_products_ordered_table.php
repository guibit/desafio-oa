<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOrderedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_ordered', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained()->onDelete('cascade');
            $table->foreignId('ordered_id')
                ->constrained()->onDelete('cascade');
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_ordered');
    }
}
