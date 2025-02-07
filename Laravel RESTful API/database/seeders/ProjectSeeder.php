<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_project')->insert([
            [
                'name' => 'E-Commerce Website',
                'projectdescription' => 'An online store for selling electronic products.',
                'customer_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Inventory Management System',
                'projectdescription' => 'A system to manage warehouse inventory.',
                'customer_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'School Management App',
                'projectdescription' => 'A mobile app to manage school operations.',
                'customer_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Online Shopping Platform',
                'projectdescription' => 'A marketplace for fashion and apparel.',
                'customer_id' => 4,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hospital Management System',
                'projectdescription' => 'Software to manage hospital operations.',
                'customer_id' => 5,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
