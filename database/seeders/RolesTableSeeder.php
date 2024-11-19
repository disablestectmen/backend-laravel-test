<?php

namespace Database\Seeders;

use App\Models\RoleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleModel::create([
            'name' => 'admin',
            'company_id' => 1, // Add a valid company_id here
        ]);
        
        RoleModel::create([
            'name' => 'manager',
            'company_id' => 1, // Or another company_id
        ]);
        
        RoleModel::create([
            'name' => 'staff',
            'company_id' => 2, // Or another company_id
        ]);
    }
}
