<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('birth_infos', function (Blueprint $table) {
        $table->unsignedBigInteger('attendant_id')->nullable()->after('profile_id');

        $table->foreign('attendant_id')
              ->references('id')
              ->on('attendants')
              ->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('birth_infos', function (Blueprint $table) {
            //
        });
    }
};
