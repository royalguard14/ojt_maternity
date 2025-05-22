<?php

namespace Database\Seeders;
use App\Models\Attendant;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Attendant::factory()->count(10)->create();



            $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ProfilesTableSeeder::class,
            ModuleSeeder::class,
            SettingSeeder::class,
            AddressDataSeeder::class,
            PrinterSetupSeeder::class,
       
            
            
        ]);
    }
}
