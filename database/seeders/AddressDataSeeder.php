<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Disable foreign key checks to allow truncating tables with dependencies
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables in reverse order of foreign key dependencies
        DB::table('table_barangay')->truncate();
        DB::table('table_municipality')->truncate();
        DB::table('table_province')->truncate();
        DB::table('table_region')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        
        $path_region = database_path('data/table_region.json');
        $path_province = database_path('data/table_province.json');
        $path_municipality = database_path('data/table_municipality.json');
        $path_barangay = database_path('data/table_barangay.json');

        $regions = json_decode(file_get_contents($path_region), true);
        $provinces = json_decode(file_get_contents($path_province), true);
        $municipalities = json_decode(file_get_contents($path_municipality), true);
        $barangays = json_decode(file_get_contents($path_barangay), true);

        foreach ($regions as $region) {
            if (!empty($region['region_id']) && !empty($region['region_name']) && !empty($region['region_description'])) {
                DB::table('table_region')->insert([
                    'region_id' => $region['region_id'],
                    'region_name' => $region['region_name'],
                    'region_description' => $region['region_description'],
                ]);
            }
        }

        foreach ($provinces as $province) {
            if (!empty($province['province_id']) && !empty($province['region_id']) && !empty($province['province_name'])) {
                DB::table('table_province')->insert([
                    'province_id' => $province['province_id'],
                    'region_id' => $province['region_id'],
                    'province_name' => $province['province_name'],
                ]);
            }
        }

        foreach ($municipalities as $municipality) {
            if (!empty($municipality['municipality_id']) && !empty($municipality['province_id']) && !empty($municipality['municipality_name'])) {
                DB::table('table_municipality')->insert([
                    'municipality_id' => $municipality['municipality_id'],
                    'province_id' => $municipality['province_id'],
                    'municipality_name' => $municipality['municipality_name'],
                ]);
            }
        }

        foreach ($barangays as $barangay) {
            if (!empty($barangay['barangay_id']) && !empty($barangay['municipality_id']) && !empty($barangay['barangay_name'])) {
                DB::table('table_barangay')->insert([
                    'barangay_id' => $barangay['barangay_id'],
                    'municipality_id' => $barangay['municipality_id'],
                    'barangay_name' => $barangay['barangay_name'],
                ]);
            }
        }
    }
}
