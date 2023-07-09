<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->foreignId('division_id')->nullable()->nullable()->constrained('divisions', 'id');
            $table->foreignId('district_id')->nullable()->nullable()->constrained('districts', 'id');
            $table->foreignId('upozila_id')->nullable()->nullable()->constrained('upozilas', 'id');
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('addresses');
    }
}
