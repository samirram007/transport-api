<?php

use App\Enums\RiderTypeEnum;
use App\Enums\SchoolTimeEnum;
use App\Enums\SectionEnum;
use App\Enums\StandardEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_snapshot_id')->nullable();
            $table->string('name');
            $table->string('code', 50)->nullable();
            $table->enum('rider_type', array_keys(RiderTypeEnum::labels()))->default(RiderTypeEnum::default());
            $table->unsignedBigInteger('profile_document_id')->constrained('documents')->nullable();
            $table->json('profile_info')->nullable();
            $table->json('academic_info')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('emergency_contact_no')->nullable();
            $table->json('guardian_info')->nullable();
            $table->date('join_date')->nullable();
            $table->date('dissociate_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->enum('standard',array_keys(StandardEnum::labels()))->default(StandardEnum::default());
            $table->enum('section',array_keys(SectionEnum::labels()))->default(SectionEnum::default());
            $table->integer('roll_no')->nullable();
            $table->enum('school_time',array_keys(SchoolTimeEnum::labels()))->default(SchoolTimeEnum::default());
            $table->unsignedBigInteger('pickup_slot_id')->nullable();
            $table->unsignedBigInteger('drop_slot_id')->nullable();
            $table->unsignedBigInteger('pickup_point_id')->nullable();
            $table->unsignedBigInteger('drop_point_id')->nullable();
            $table->time('pickup_time')->nullable();
            $table->time('drop_time')->nullable();
            $table->unsignedBigInteger('journey_type_id')->nullable();
            $table->boolean('is_free')->default(false);
            $table->decimal('monthly_charge',10,6)->default(0);
            $table->boolean('is_idcard_printable')->default(false);
            $table->integer('idcard_print_count')->default(0);
            $table->boolean('is_release_idcard_printable')->default(false);
            $table->integer('release_idcard_print_count')->default(0);
            $table->date('next_fees_date')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};
