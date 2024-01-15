<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "الشركات", "en": "Companies"}',
                'sub_of' => '0',
                'icon' => 'fas fa-building',
                'route' => 'companySection.index',
                'order' => 2,
                'trash' => 0,
                'section_side' => 'admin',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-03-03 07:29:51',
                'updated_at' => '2021-05-27 08:03:47',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "الصفحة الرئيسية", "en": "Home"}',
                'sub_of' => '0',
                'icon' => 'flaticon-home-2',
                'route' => 'home',
                'order' => 50,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-03-07 07:24:16',
                'updated_at' => '2021-03-09 11:21:27',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "Dashboard", "en": "Dashboard"}',
                'sub_of' => '0',
                'icon' => 'flaticon-home-2',
                'route' => NULL,
                'order' => 50,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-03-07 07:24:16',
                'updated_at' => '2022-02-01 13:39:31',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 16,
                'name' => '{"ar": "الأقسام", "en": "Features"}',
                'sub_of' => '0',
                'icon' => 'fas fa-puzzle-piece',
                'route' => 'section.index',
                'order' => 3,
                'trash' => 0,
                'section_side' => 'admin',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-05-27 07:06:55',
                'updated_at' => '2021-05-27 08:10:08',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 17,
                'name' => '{"ar": "المستخدمين", "en": "Admin Users"}',
                'sub_of' => '0',
                'icon' => 'fas fa-users',
                'route' => 'user.index',
                'order' => 4,
                'trash' => 0,
                'section_side' => 'admin',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-05-27 09:57:40',
                'updated_at' => '2021-05-27 09:59:53',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 19,
                'name' => '{"ar": "أيقونة المعلومات", "en": "Tool Tip Data"}',
                'sub_of' => '0',
                'icon' => 'fas fa-question',
                'route' => 'toolTipData.index',
                'order' => 6,
                'trash' => 0,
                'section_side' => 'admin',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-09-23 11:08:29',
                'updated_at' => '2021-09-23 11:12:33',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 20,
                'name' => '{"ar": "الأدوار والأذونات", "en": "Roles & Permissions"}',
                'sub_of' => '0',
                'icon' => 'fas fa-key',
                'route' => 'roles.permissions.index',
                'order' => 7,
                'trash' => 0,
                'section_side' => 'admin',
                'updated_by' => NULL,
                'created_by' => 1,
                'created_at' => '2021-10-17 09:39:04',
                'updated_at' => '2021-10-17 09:39:04',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 21,
                'name' => '{"ar": "Tables & Data Gathering", "en": "Tables & Data Gathering"}',
                'sub_of' => '0',
                'icon' => 'flaticon-line-graph',
                'route' => NULL,
                'order' => 54,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2022-01-03 10:47:14',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 22,
                'name' => '{"ar": "Sales Data", "en": "Sales Data"}',
                'sub_of' => '21',
                'icon' => 'fa fa-crosshairs',
                'route' => 'salesGathering.index',
                'order' => 58,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 23,
                'name' => '{"ar": "الاعدادت", "en": "Setting"}',
                'sub_of' => '0',
                'icon' => 'flaticon-line-graph',
                'route' => NULL,
                'order' => 55,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-09 11:41:17',
                'updated_at' => '2022-01-03 10:47:14',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 24,
                'name' => '{"ar": "انواع الايرادات", "en": "Revenue Business Line"}',
                'sub_of' => '23',
                'icon' => 'fa fa-crosshairs',
                'route' => 'admin.view.revenue.business.line',
                'order' => 59,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 25,
                'name' => '{"ar": "Quick Pricing Calculator", "en": "Quick Pricing Calculator"}',
                'sub_of' => '23',
                'icon' => 'fa fa-crosshairs',
                'route' => 'admin.view.quick.pricing.calculator',
                'order' => 60,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 26,
                'name' => '{"ar": "Quotations Pricing Calculator", "en": "Quotations Pricing Calculator"}',
                'sub_of' => '23',
                'icon' => 'fa fa-crosshairs',
                'route' => 'admin.view.quotation.pricing.calculator',
                'order' => 60,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 27,
                'name' => '{"ar": "Upload Excel", "en": "Upload Excel"}',
                'sub_of' => '21',
                'icon' => 'fa fa-crosshairs',
                'route' => 'uploadExcel.index',
                'order' => 59,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),
             14 => 
            array (
                'id' => 28,
                'name' => '{"ar": "Sharable Links", "en": "Sharable Links"}',
                'sub_of' => '23',
                'icon' => 'fa fa-crosshairs',
                'route' => 'sharing-links.index',
                'order' => 61,
                'trash' => 1,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),

            15 => 
            array (
                'id' => 29,
                'name' => '{"ar": "Upload Suppliers Invoices", "en": "Upload Suppliers Invoices"}',
                'sub_of' => '21',
                'icon' => 'fa fa-crosshairs',
                'route' => 'uploadSupplierInvoice.index',
                'order' => 59,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),

            16 => 
            array (
                'id' => 30,
                'name' => '{"ar": "Income Statement", "en": "Income Statement"}',
                'sub_of' => '23',
                'icon' => 'fa fa-crosshairs',
                'route' => 'admin.view.income.statement',
                'order' => 60,
                'trash' => 0,
                'section_side' => 'client',
                'updated_by' => 1,
                'created_by' => 1,
                'created_at' => '2021-12-15 11:22:35',
                'updated_at' => '2022-01-03 10:48:41',
                'deleted_at' => NULL,
            ),

        ));
        
        
    }
}