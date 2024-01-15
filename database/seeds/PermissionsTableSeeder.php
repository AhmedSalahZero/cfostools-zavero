<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'home.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'home.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'home.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'home.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'home.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'dashboard.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'dashboard.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'dashboard.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'dashboard.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'dashboard.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'customersInvoice.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'customersInvoice.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'customersInvoice.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'customersInvoice.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'customersInvoice.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'suppliersInvoice.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'suppliersInvoice.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'suppliersInvoice.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'suppliersInvoice.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'suppliersInvoice.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'exchangeRatesUpdate.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'exchangeRatesUpdate.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'exchangeRatesUpdate.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'exchangeRatesUpdate.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'exchangeRatesUpdate.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'financialInstitution.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'financialInstitution.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'financialInstitution.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'financialInstitution.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'financialInstitution.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'moneyReceived.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'moneyReceived.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'moneyReceived.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'moneyReceived.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'moneyReceived.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'chequesCollection.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'chequesCollection.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'chequesCollection.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'chequesCollection.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'chequesCollection.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'lg.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'lg.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'lg.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'lg.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'lg.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'lc.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'lc.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'lc.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'lc.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'lc.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'moneyPayment.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'moneyPayment.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'moneyPayment.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'moneyPayment.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'moneyPayment.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'contractActivity.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'contractActivity.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'contractActivity.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'contractActivity.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'contractActivity.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'contractPlan.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'contractPlan.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:39',
                'updated_at' => '2021-10-18 10:56:39',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'contractPlan.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'contractPlan.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'contractPlan.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => '.view',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => '.create',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => '.edit',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => '.delete',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => '.*',
                'guard_name' => 'web',
                'created_at' => '2021-10-18 10:56:40',
                'updated_at' => '2021-10-18 10:56:40',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'view salesGathering',
                'guard_name' => 'web',
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2021-12-09 11:41:17',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'create salesGathering',
                'guard_name' => 'web',
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2021-12-09 11:41:17',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'edit salesGathering',
                'guard_name' => 'web',
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2021-12-09 11:41:17',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'delete salesGathering',
                'guard_name' => 'web',
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2021-12-09 11:41:17',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'view end',
                'guard_name' => 'web',
                'created_at' => '2021-12-12 10:29:45',
                'updated_at' => '2021-12-12 10:29:45',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'create end',
                'guard_name' => 'web',
                'created_at' => '2021-12-12 10:29:45',
                'updated_at' => '2021-12-12 10:29:45',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'edit end',
                'guard_name' => 'web',
                'created_at' => '2021-12-12 10:29:45',
                'updated_at' => '2021-12-12 10:29:45',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'delete end',
                'guard_name' => 'web',
                'created_at' => '2021-12-12 10:29:45',
                'updated_at' => '2021-12-12 10:29:45',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'view zone',
                'guard_name' => 'web',
                'created_at' => '2021-12-14 11:03:51',
                'updated_at' => '2021-12-14 11:03:51',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'create zone',
                'guard_name' => 'web',
                'created_at' => '2021-12-14 11:03:51',
                'updated_at' => '2021-12-14 11:03:51',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'edit zone',
                'guard_name' => 'web',
                'created_at' => '2021-12-14 11:03:51',
                'updated_at' => '2021-12-14 11:03:51',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'delete zone',
                'guard_name' => 'web',
                'created_at' => '2021-12-14 11:03:51',
                'updated_at' => '2021-12-14 11:03:51',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'view inventoryStatement',
                'guard_name' => 'web',
                'created_at' => '2021-12-15 10:50:37',
                'updated_at' => '2021-12-15 10:50:37',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'create inventoryStatement',
                'guard_name' => 'web',
                'created_at' => '2021-12-15 10:50:37',
                'updated_at' => '2021-12-15 10:50:37',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'edit inventoryStatement',
                'guard_name' => 'web',
                'created_at' => '2021-12-15 10:50:37',
                'updated_at' => '2021-12-15 10:50:37',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'delete inventoryStatement',
                'guard_name' => 'web',
                'created_at' => '2021-12-15 10:50:37',
                'updated_at' => '2021-12-15 10:50:37',
            ),
        ));
        
        
    }
}