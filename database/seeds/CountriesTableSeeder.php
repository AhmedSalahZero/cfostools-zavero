<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Egypt',
                'name_ar' => 'مصر‎',
                'created_at' => '2018-07-20 20:11:03',
                'updated_at' => '2020-12-03 15:35:17',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Saudi Arabia',
                'name_ar' => 'المملكة العربية السعودية',
                'created_at' => '2018-07-20 20:11:03',
                'updated_at' => '2020-12-09 11:35:52',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'United Arab Emirates',
                'name_ar' => 'دولة الإمارات العربية المتحدة',
                'created_at' => '2018-07-20 20:11:03',
                'updated_at' => '2020-12-04 00:47:45',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'United States',
                'name_ar' => 'الولايات المتحده الأمريكيه',
                'created_at' => NULL,
                'updated_at' => '2020-12-11 12:03:29',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name_en' => 'Kuwait',
                'name_ar' => 'الكويت',
                'created_at' => NULL,
                'updated_at' => '2020-12-09 11:41:11',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name_en' => 'Kenya',
                'name_ar' => 'كينيا',
                'created_at' => NULL,
                'updated_at' => '2020-12-09 11:43:55',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name_en' => 'Jordan',
                'name_ar' => 'الأردن',
                'created_at' => NULL,
                'updated_at' => '2020-12-09 11:43:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}