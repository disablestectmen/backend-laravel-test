<?php

namespace Database\Seeders;

use App\Models\CompanyModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyModel::create([
            'name' => 'Perusahaan A',
            'email' => 'contact@companyA.com',
            'phone_number' => '081234567890',
        ]);

        CompanyModel::create([
            'name' => 'Perusahaan B',
            'email' => 'contact@companyB.com',
            'phone_number' => '081234567891',
        ]);

        CompanyModel::create([
            'name' => 'Perusahaan C',
            'email' => 'contact@companyC.com',
            'phone_number' => '081234567892',
        ]);
    }
}
