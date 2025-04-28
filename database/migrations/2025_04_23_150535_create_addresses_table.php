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
        // table_region
        Schema::create('table_region', function (Blueprint $table) {
            $table->id('region_id');
            $table->string('region_name', 50)->unique();
            $table->string('region_description', 100);
            $table->timestamps();

            $table->index('region_name', 'IDX_region_name');
        });

        // table_province
        Schema::create('table_province', function (Blueprint $table) {
            $table->id('province_id');
            $table->unsignedBigInteger('region_id');
            $table->string('province_name', 100);
            $table->timestamps();

            $table->unique(['region_id', 'province_name'], 'UQT_provincename');
            $table->index('province_name', 'IDX_province_name');
            $table->index('region_id', 'IDX_region_id');

            $table->foreign('region_id', 'FK_table_province_table_region')
                ->references('region_id')
                ->on('table_region')
                ->onDelete('cascade');
        });

        // table_municipality
        Schema::create('table_municipality', function (Blueprint $table) {
            $table->id('municipality_id');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('municipality_name', 100)->nullable();
            $table->timestamps();

            $table->unique(['province_id', 'municipality_name'], 'UQT_municipality');
            $table->index('province_id', 'IDX_province_id');
            $table->index('municipality_name', 'IDX_municipality_name');

            $table->foreign('province_id', 'FK_table_municipality_table_province')
                ->references('province_id')
                ->on('table_province')
                ->onDelete('set null');
        });

        // table_barangay
        Schema::create('table_barangay', function (Blueprint $table) {
            $table->id('barangay_id');
            $table->unsignedBigInteger('municipality_id');
            $table->string('barangay_name', 100);
            $table->timestamps();

            $table->unique(['municipality_id', 'barangay_name'], 'UQT_barangay');
            $table->index('barangay_name', 'IDX_barangay_name');

            $table->foreign('municipality_id', 'FK_table_barangay_table_municipality')
                ->references('municipality_id')
                ->on('table_municipality')
                ->onDelete('cascade');
        });

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
        Schema::dropIfExists('table_barangay');
        Schema::dropIfExists('table_municipality');
        Schema::dropIfExists('table_province');
        Schema::dropIfExists('table_region');
    }
};
