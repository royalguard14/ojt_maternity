<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {




 Module::create([
    'name' => 'Roles',
    'icon' => 'fa-users',
    'description' => 'Manage roles within the system and assign permissions to users.',
    'url' => 'roles.index'  
]);

Module::create([
    'name' => 'Users',
    'icon' => 'fa-users',
    'description' => 'Manage individual users, their details, and roles within the system.',
    'url' => 'users.index'  
]);

Module::create([
    'name' => 'Modules',
    'icon' => 'fa-cogs',
    'description' => 'Configure and manage system modules and their settings.',
    'url' => 'modules.index'  
]);

Module::create([
    'name' => 'Settings',
    'icon' => 'fa-cogs',
    'description' => 'Manage global system settings, including configurations and preferences.',
    'url' => 'settings.index'  
]);





















        
        Module::create([
            'name' => 'Patient Management',
            'icon' => 'fa-id-card',
            'description' => 'Register patients, view profiles, and access medical history.',
            'url' => 'patients.index',
        ]);

        // Module::create([
        //     'name' => 'Prenatal Checkups',
        //     'icon' => 'fa-stethoscope',
        //     'description' => 'Record prenatal vitals, ultrasound results, and scheduled visits.',
        //     'url' => 'prenatal.index',
        // ]);

        // Module::create([
        //     'name' => 'Childbirth Records',
        //     'icon' => 'fa-heartbeat',
        //     'description' => 'Record delivery details, birth weight, and APGAR scores.',
        //     'url' => 'childbirth.index',
        // ]);

        // Module::create([
        //     'name' => 'Postnatal Monitoring',
        //     'icon' => 'fa-baby-carriage',
        //     'description' => 'Monitor the health and vaccinations of mothers and infants after birth.',
        //     'url' => 'postnatal.index',
        // ]);

        // Module::create([
        //     'name' => 'Family Planning Services',
        //     'icon' => 'fa-venus-mars',
        //     'description' => 'Manage counseling, chosen methods, and follow-up visits for family planning.',
        //     'url' => 'familyplanning.index',
        // ]);



Module::create([
    'name' => 'Maternal',
    'icon' => 'fa-female',
    'description' => 'Manage maternal health records and related services.',
    'url' => 'family.maternal',
]);

Module::create([
    'name' => 'Paternal',
    'icon' => 'fa-male',
    'description' => 'Manage paternal information and involvement in family healthcare.',
    'url' => 'family.paternal',
]);

Module::create([
    'name' => 'Offspring',
    'icon' => 'fa-child',
    'description' => 'Track health records and information for children and minors.',
    'url' => 'family.offspring',
]);




Module::create([
    'name' => 'Attendant',
    'icon' => 'fa-users',
    'description' => 'Manage Attendant',
    'url' => 'attendant.index',
]);




        
    }
}
