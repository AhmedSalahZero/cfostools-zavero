<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'super-admin',
                'scope' => NULL,
                'guard_name' => 'web',
                'created_at' => '2021-10-18 11:14:22',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Admin',
                'scope' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 12:56:35',
                'updated_at' => '2021-10-18 12:56:35',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Manager',
                'scope' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 12:57:08',
                'updated_at' => '2021-10-18 12:57:08',
            ),
        ));
        
        
    }
}