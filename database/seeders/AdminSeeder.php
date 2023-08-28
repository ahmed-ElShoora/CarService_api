<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>'$2y$10$gg5s3X80jUmuho3GBbssjunkhYKqiz0kD6/ilrDKShqOJn8qh8uFe'
        ]);
    }
}
