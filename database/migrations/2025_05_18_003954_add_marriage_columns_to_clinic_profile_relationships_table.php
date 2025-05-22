<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarriageColumnsToClinicProfileRelationshipsTable extends Migration
{
    public function up()
    {
        Schema::table('clinic_profile_relationships', function (Blueprint $table) {
            $table->boolean('is_married')->default(false);
            $table->date('date_of_marriage')->nullable();
            $table->string('place_of_marriage')->nullable();
        });
    }

    public function down()
    {
        Schema::table('clinic_profile_relationships', function (Blueprint $table) {
            $table->dropColumn('is_married');
            $table->dropColumn('date_of_marriage');
            $table->dropColumn('place_of_marriage');
        });
    }
}
