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
        Schema::create('sale_entries', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->bigInteger('customer_id')->unsigned();
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->double('total_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_entries');
    }
};
