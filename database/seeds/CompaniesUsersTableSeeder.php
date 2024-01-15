<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompaniesUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies_users')->delete();
        
        \DB::table('companies_users')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'company_id' => 31,
            ),
            1 => 
            array (
                'user_id' => 1,
                'company_id' => 38,
            ),
        ));
        
        
    }
}