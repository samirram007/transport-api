<?php

use App\Enums\SlotTypeEnum;
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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Morning, Evening, Night
            $table->enum('slot_type',array_keys(SlotTypeEnum::labels()))->default(SlotTypeEnum::default());
            $table->string('vehicle_id');
            $table->string('team_id')->nullable();
            $table->string('capacity')->default(50);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
