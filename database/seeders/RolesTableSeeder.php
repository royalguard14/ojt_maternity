<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('roles')->insert([
        'role_name' => 'Developer',
        'modules' => json_encode([1,2,3,4,5,6,7,8,9]),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

     DB::table('roles')->insert([
        'role_name' => 'Clerk',
            'modules' => json_encode([5,6,7,8]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

     DB::table('roles')->insert([
        'role_name' => 'Midwife',
            'modules' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

     DB::table('roles')->insert([
        'role_name' => 'Doctor',
            'modules' => json_encode([]),  
            'created_at' => now(),
            'updated_at' => now(),
        ]);
 }
}
