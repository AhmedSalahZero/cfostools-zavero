<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Mahmoud  Youssef',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$mWFMwplFewnUutmHSprfkOLyEwUGQAyPEZAbSHTVuN.yUaJ04qXtW',
                'subscription' => NULL,
                'expiration_date' => NULL,
                'acceptance_of_privacy_policy' => NULL,
                'remember_token' => '6TtPIkm0WKK3VAU1Bj3MSQovC6r88HB40rVnt5TSzBYKtYcTImj50FrdbVOi',
                'created_by' => NULL,
                'updated_by' => 1,
                'created_at' => '2021-05-25 15:19:01',
                'updated_at' => '2022-02-17 13:33:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}