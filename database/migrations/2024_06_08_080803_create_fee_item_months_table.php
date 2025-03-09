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

        Schema::create('fee_item_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fee_item_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('month_id');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_item_months');
    }
};
