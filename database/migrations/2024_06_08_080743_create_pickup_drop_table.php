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
        Schema::create('pickup_drops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('pickup_drop_points_id')->nullable();
            $table->date('pickup_drop_date');
            $table->time('pickup_time')->nullable();
            $table->time('drop_time')->nullable();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('journey_type_id')->nullable();
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->integer('status')->comment('1=Active,2=Inactive,3=Deleted')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_drops');
    }
};
