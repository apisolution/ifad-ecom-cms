<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_category_id')->nullable()->constrained('combo_categories', 'id');
            $table->string('title')->nullable();
            $table->string('sku')->nullable()->unique();
            $table->float('sale_price')->nullable();
            $table->float('offer_price')->nullable();
            $table->timestamp('offer_start')->nullable();
            $table->timestamp('offer_end')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->integer('reorder_quantity')->nullable();
            $table->enum('is_special_deal', ['1', '2'])->nullable();
            $table->enum('is_manage_stock', ['1', '2'])->nullable();
            $table->integer('min_order_quantity')->nullable();
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
        Schema::dropIfExists('combos');
    }
}
