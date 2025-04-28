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
   Schema::create('clinic_profile_relationships', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('mother_id')->nullable();
    $table->unsignedBigInteger('father_id')->nullable();
    $table->json('child_ids')->nullable(); // store array like [1, 2, 3]
    $table->timestamps();

    $table->foreign('mother_id')->references('id')->on('clinic_profiles')->onDelete('cascade');
    $table->foreign('father_id')->references('id')->on('clinic_profiles')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_profile_relationships');
    }
};
