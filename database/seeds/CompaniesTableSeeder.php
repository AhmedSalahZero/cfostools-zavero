<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'id' => 31,
                'name' => '{"ar": "Vero Company", "en": "Vero Company"}',
                'sub_of' => '0',
                'updated_by' => NULL,
                'created_by' => 1,
                'created_at' => '2022-01-13 14:40:58',
                'updated_at' => '2022-01-13 14:40:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 38,
                'name' => '{"ar": "EDGE Consultant", "en": "EDGE Consultant"}',
                'sub_of' => '0',
                'updated_by' => NULL,
                'created_by' => 1,
                'created_at' => '2022-06-01 00:40:41',
                'updated_at' => '2022-06-01 00:40:41',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}