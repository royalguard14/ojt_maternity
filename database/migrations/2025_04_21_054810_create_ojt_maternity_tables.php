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
        Schema::create('clinic_profiles', function (Blueprint $table) {
            $table->id();
            $table->enum('data_spec', ['mother', 'father','child']);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birth_date');

            $table->string('place_of_birth_brgy')->nullable();
            $table->string('place_of_birth_city')->nullable();
            $table->string('place_of_birth_province')->nullable();
            $table->string('place_of_birth_country')->nullable();

            $table->string('residence_brgy')->nullable();
            $table->string('residence_city')->nullable();
            $table->string('residence_province')->nullable();
            $table->string('residence_country')->nullable();

            $table->enum('gender', ['male', 'female']);

            $table->string('phone')->nullable();
            $table->string('occupation')->nullable();
            $table->string('religion')->nullable();
            $table->string('citizenship')->nullable();
            $table->timestamps();
        });
        // Schema::create('prenatal_checkups', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        //     $table->date('checkup_date');
        //     $table->float('weight')->nullable();
        //     $table->float('blood_pressure')->nullable();
        //     $table->text('notes')->nullable();
        //     $table->string('ultrasound_result')->nullable();
        //     $table->timestamps();
        // });
        // Schema::create('childbirth_records', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        //     $table->date('delivery_date');
        //     $table->string('delivery_type');
        //     $table->float('birth_weight');
        //     $table->string('apgar_score')->nullable();
        //     $table->text('complications')->nullable();
        //     $table->timestamps();
        // });
        // Schema::create('postnatal_monitorings', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        //     $table->date('monitoring_date');
        //     $table->enum('for_whom', ['mother', 'baby']);
        //     $table->text('health_status')->nullable();
        //     $table->string('vaccine_given')->nullable();
        //     $table->text('notes')->nullable();
        //     $table->timestamps();
        // });
        // Schema::create('family_planning_records', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        //     $table->date('counseling_date');
        //     $table->string('method_chosen');
        //     $table->text('remarks')->nullable();
        //     $table->date('follow_up_date')->nullable();
        //     $table->timestamps();
        // });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
        // Schema::dropIfExists('prenatal_checkups');
        // Schema::dropIfExists('childbirth_records');
        // Schema::dropIfExists('postnatal_monitorings');
        // Schema::dropIfExists('family_planning_records');
    }
};