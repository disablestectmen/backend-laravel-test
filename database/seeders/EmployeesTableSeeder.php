<?php

namespace Database\Seeders;

use App\Models\EmployeeModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeModel::create([
            'name' => 'Karyawan A',
            'phone_number' => '081234567890',
            'address' => 'Alamat A',
            'company_id' => 1, // ID Perusahaan A
        ]);

        EmployeeModel::create([
            'name' => 'Karyawan B',
            'phone_number' => '081234567891',
            'address' => 'Alamat B',
            'company_id' => 2, // ID Perusahaan B
        ]);

        EmployeeModel::create([
            'name' => 'Karyawan C',
            'phone_number' => '081234567892',
            'address' => 'Alamat C',
            'company_id' => 3, // ID Perusahaan C
        ]);
    }
}
