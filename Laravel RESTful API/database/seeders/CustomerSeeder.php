<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_customer')->insert([
            [
                'name' => 'Abdul Karim',
                'phone' => '01711111111',
                'email' => 'karim@gmail.com',
                'comapny' => 'Karim Traders',
                'address' => 'Gulshan, Dhaka',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rahima Begum',
                'phone' => '01822222222',
                'email' => 'rahima@yahoo.com',
                'comapny' => 'Rahima Enterprises',
                'address' => 'Dhanmondi, Dhaka',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Md. Asif Khan',
                'phone' => '01933333333',
                'email' => 'asif@gmail.com',
                'comapny' => 'Khan Technologies',
                'address' => 'Uttara, Dhaka',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shirin Akter',
                'phone' => '01744444444',
                'email' => 'shirin@gmail.com',
                'comapny' => 'Shirin Fashion',
                'address' => 'Banani, Dhaka',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jahidul Islam',
                'phone' => '01855555555',
                'email' => 'jahid@gmail.com',
                'comapny' => 'Jahid IT Solutions',
                'address' => 'Mirpur, Dhaka',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
