<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('order_items', function (Blueprint $table) {
$table->id();
$table->foreignId('order_id')->constrained()->cascadeOnDelete();
$table->foreignId('product_id')->constrained()->cascadeOnDelete();
$table->integer('amount');
$table->integer('price_order')->nullable();
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
        //
    }
};
