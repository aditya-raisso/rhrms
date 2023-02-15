<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Module::create([
            'module_name' => 'Role',
        ]);

        Module::create([
            'module_name' => 'Permission',
        ]);

        Module::create([
            'module_name' => 'Category',
        ]);

        Module::create([
            'module_name' => 'Employee',
        ]);

         Module::create([
            'module_name' => 'Attendance',
        ]);

       
        
    }
}
