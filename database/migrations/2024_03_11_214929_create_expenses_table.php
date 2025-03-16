<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_year_id');
            $table->string('expense_no');
            $table->string('voucher_no')->nullable();
            $table->date('expense_date');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_mode')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('document_id')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
