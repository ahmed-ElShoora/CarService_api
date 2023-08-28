<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intros')->insert([
            'id'=>1,
            'image'=>'image',
            'title'=>'تجربة 1',
            'desc'=>'وصف 1',
            'app'=>'1'
        ]);

        DB::table('intros')->insert([
            'id'=>2,
            'image'=>'image',
            'title'=>'تجربة 1',
            'desc'=>'وصف 1',
            'app'=>'2'
        ]);

        DB::table('intros')->insert([
            'id'=>3,
            'image'=>'image',
            'title'=>'تجربة 2',
            'desc'=>'وصف 2',
            'app'=>'1'
        ]);

        DB::table('intros')->insert([
            'id'=>4,
            'image'=>'image',
            'title'=>'تجربة 2',
            'desc'=>'وصف 2',
            'app'=>'2'
        ]);
    }
}
