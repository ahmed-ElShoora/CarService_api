<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SplashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'var'=>'logo_phane',
            'val'=>'image'
        ]);

        DB::table('settings')->insert([
            'var'=>'logo_client',
            'val'=>'image'
        ]);
    }
}
