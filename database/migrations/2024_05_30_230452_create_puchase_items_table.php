<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('puchase_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->on('items')->references('id')->onDelete('cascade');
            $table->bigInteger('unit_id')->unsigned();
            $table->foreign('unit_id')->on('units')->references('id')->onDelete('cascade');
            $table->integer('qty');
            $table->double('price,16,2');
            $table->integer('totalAmount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puchase_items');
    }
};
