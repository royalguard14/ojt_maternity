<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendant;

class AttendantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Attendant::create([
            'name' => 'Nonita L. Borromeo',
            'position' => 'Midwife ',
            'address' => 'Taligaman|Butuan City',
        ]);



     Attendant::create([
            'name' => 'Teofila C. Manuel',
            'position' => 'Midwife ',
            'address' => 'Taligaman|Butuan City',
        ]);



          Attendant::create([
            'name' => 'Dr. Benjamin B. Selim Jr',
            'position' => 'Obstetrician ',
            'address' => 'Taligaman|Butuan City',
        ]);





    }
}
