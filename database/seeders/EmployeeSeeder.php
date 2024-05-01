<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Rama Adhitya Setiadi',
            'nik' => 123456789,
            'position' => 'Head Of IT',
            'phone' => "0895347113987",
            'password' => bcrypt('password')
        ]);
    }
}
