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
      Schema::create('printer_setups', function (Blueprint $table) {
    $table->id();
    $table->string('printer_brand');
    $table->string('printer_unit');
    $table->string('form_no')->unique();
    $table->json('printer_setting'); // field positions as JSON
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer_setups');
    }
};
