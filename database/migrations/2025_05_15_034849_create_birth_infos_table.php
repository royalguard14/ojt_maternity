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
        Schema::create('birth_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')
                ->constrained('clinic_profiles')
                ->onDelete('cascade');

            $table->string('type_of_birth')->nullable(); // e.g., 'single', 'twin', etc.
            $table->string('child_was')->nullable(); // e.g., 'premature', 'full term'
            $table->string('birth_order')->nullable(); // e.g., 'first', 'second'
            $table->integer('weight_at_birth')->nullable(); // in grams
            $table->integer('total_number_of_children_alive')->nullable();
            $table->integer('number_of_children_still_leaving')->nullable();
            $table->integer('total_number_of_children_alive_dead')->nullable();
            $table->integer('age_of_father')->nullable();
            $table->integer('age_of_mother')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_infos');
    }
};
