<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'code' => 'en',
                'updated_by' => NULL,
                'created_by' => NULL,
                'created_at' => '2021-05-27 09:04:17',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Arabic',
                'code' => 'ar',
                'updated_by' => NULL,
                'created_by' => NULL,
                'created_at' => '2021-05-27 09:03:55',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}