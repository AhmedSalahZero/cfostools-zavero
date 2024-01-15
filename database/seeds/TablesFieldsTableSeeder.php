<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TablesFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tables_fields')->delete();
        
        \DB::table('tables_fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'model_name' => 'SalesGathering',
                'field_name' => 'date',
                'view_name' => 'Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            1 => 
            array (
                'id' => 2,
                'model_name' => 'SalesGathering',
                'field_name' => 'country',
                'view_name' => 'Country',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            2 => 
            array (
                'id' => 3,
                'model_name' => 'SalesGathering',
                'field_name' => 'local_or_export',
                'view_name' => 'Local Or Export',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            3 => 
            array (
                'id' => 4,
                'model_name' => 'SalesGathering',
                'field_name' => 'branch',
                'view_name' => 'Branch',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            4 => 
            array (
                'id' => 5,
                'model_name' => 'SalesGathering',
                'field_name' => 'document_type',
                'view_name' => 'Document Type',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            5 => 
            array (
                'id' => 6,
                'model_name' => 'SalesGathering',
                'field_name' => 'document_number',
                'view_name' => 'Document Number',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            6 => 
            array (
                'id' => 7,
                'model_name' => 'SalesGathering',
                'field_name' => 'sales_person',
                'view_name' => 'Sales Person',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            7 => 
            array (
                'id' => 8,
                'model_name' => 'SalesGathering',
                'field_name' => 'customer_code',
                'view_name' => 'Customer Code',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            8 => 
            array (
                'id' => 9,
                'model_name' => 'SalesGathering',
                'field_name' => 'customer_name',
                'view_name' => 'Customer Name',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            9 => 
            array (
                'id' => 10,
                'model_name' => 'SalesGathering',
                'field_name' => 'business_sector',
                'view_name' => 'Business Sector',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            10 => 
            array (
                'id' => 11,
                'model_name' => 'SalesGathering',
                'field_name' => 'zone',
                'view_name' => 'Zone',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            11 => 
            array (
                'id' => 12,
                'model_name' => 'SalesGathering',
                'field_name' => 'sales_channel',
                'view_name' => 'Sales Channel',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            12 => 
            array (
                'id' => 13,
                'model_name' => 'SalesGathering',
                'field_name' => 'service_provider_type',
                'view_name' => 'Service Provider Type',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            13 => 
            array (
                'id' => 14,
                'model_name' => 'SalesGathering',
                'field_name' => 'service_provider_name',
                'view_name' => 'Service Provider Name',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            14 => 
            array (
                'id' => 15,
                'model_name' => 'SalesGathering',
                'field_name' => 'service_provider_birth_year',
                'view_name' => 'Service Provider Birth Year',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            15 => 
            array (
                'id' => 16,
                'model_name' => 'SalesGathering',
                'field_name' => 'principle',
                'view_name' => 'Principle',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            16 => 
            array (
                'id' => 17,
                'model_name' => 'SalesGathering',
                'field_name' => 'category',
                'view_name' => 'Category',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            17 => 
            array (
                'id' => 18,
                'model_name' => 'SalesGathering',
                'field_name' => 'sub_category',
                'view_name' => 'Sub Category',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            18 => 
            array (
                'id' => 19,
                'model_name' => 'SalesGathering',
                'field_name' => 'product_or_service',
                'view_name' => 'Product Or Service Name',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            19 => 
            array (
                'id' => 20,
                'model_name' => 'SalesGathering',
                'field_name' => 'product_item',
                'view_name' => 'Product Item',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            20 => 
            array (
                'id' => 21,
                'model_name' => 'SalesGathering',
                'field_name' => 'measurment_unit',
                'view_name' => 'Measurment Unit',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            21 => 
            array (
                'id' => 22,
                'model_name' => 'SalesGathering',
                'field_name' => 'return_reason',
                'view_name' => 'Return Reason',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            22 => 
            array (
                'id' => 23,
                'model_name' => 'SalesGathering',
                'field_name' => 'quantity',
                'view_name' => 'Quantity',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            23 => 
            array (
                'id' => 24,
                'model_name' => 'SalesGathering',
                'field_name' => 'quantity_status',
                'view_name' => 'Quantity Status',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            24 => 
            array (
                'id' => 25,
                'model_name' => 'SalesGathering',
                'field_name' => 'quantity_bonus',
                'view_name' => 'Quantity Bonus',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            25 => 
            array (
                'id' => 26,
                'model_name' => 'SalesGathering',
                'field_name' => 'price_per_unit',
                'view_name' => 'Price Per Unit',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            26 => 
            array (
                'id' => 27,
                'model_name' => 'SalesGathering',
                'field_name' => 'sales_value',
                'view_name' => 'Sales Value',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            27 => 
            array (
                'id' => 28,
                'model_name' => 'SalesGathering',
                'field_name' => 'quantity_discount',
                'view_name' => 'Quantity Discount',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            28 => 
            array (
                'id' => 29,
                'model_name' => 'SalesGathering',
                'field_name' => 'cash_discount',
                'view_name' => 'Cash Discount',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            29 => 
            array (
                'id' => 30,
                'model_name' => 'SalesGathering',
                'field_name' => 'special_discount',
                'view_name' => 'Special Discount',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            30 => 
            array (
                'id' => 31,
                'model_name' => 'SalesGathering',
                'field_name' => 'other_discounts',
                'view_name' => 'Other Discounts',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            31 => 
            array (
                'id' => 32,
                'model_name' => 'SalesGathering',
                'field_name' => 'net_sales_value',
                'view_name' => 'Net Sales Value',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            32 => 
            array (
                'id' => 33,
                'model_name' => 'inventoryStatement',
                'field_name' => 'type',
                'view_name' => 'Type',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            33 => 
            array (
                'id' => 34,
                'model_name' => 'inventoryStatement',
                'field_name' => 'date',
                'view_name' => 'Date',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            34 => 
            array (
                'id' => 35,
                'model_name' => 'inventoryStatement',
                'field_name' => 'document_num',
                'view_name' => 'Document Num',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            35 => 
            array (
                'id' => 36,
                'model_name' => 'inventoryStatement',
                'field_name' => 'name',
                'view_name' => 'Name',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            36 => 
            array (
                'id' => 37,
                'model_name' => 'inventoryStatement',
                'field_name' => 'category',
                'view_name' => 'Category',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            37 => 
            array (
                'id' => 38,
                'model_name' => 'inventoryStatement',
                'field_name' => 'local_or_imported',
                'view_name' => 'Local Or Imported',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            38 => 
            array (
                'id' => 39,
                'model_name' => 'inventoryStatement',
                'field_name' => 'sub_category',
                'view_name' => 'Sub Category',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            39 => 
            array (
                'id' => 40,
                'model_name' => 'inventoryStatement',
                'field_name' => 'product',
                'view_name' => 'Product',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            40 => 
            array (
                'id' => 41,
                'model_name' => 'inventoryStatement',
                'field_name' => 'product_sku',
                'view_name' => 'Product Sku',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            41 => 
            array (
                'id' => 42,
                'model_name' => 'inventoryStatement',
                'field_name' => 'measurment_unit',
                'view_name' => 'Measurment Unit',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            42 => 
            array (
                'id' => 43,
                'model_name' => 'inventoryStatement',
                'field_name' => 'beginning_balance',
                'view_name' => 'Beginning Balance',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            43 => 
            array (
                'id' => 44,
                'model_name' => 'inventoryStatement',
                'field_name' => 'volume_in',
                'view_name' => 'Volume In',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            44 => 
            array (
                'id' => 45,
                'model_name' => 'inventoryStatement',
                'field_name' => 'volume_out',
                'view_name' => 'Volume Out',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),
            45 => 
            array (
                'id' => 46,
                'model_name' => 'inventoryStatement',
                'field_name' => 'end_balance',
                'view_name' => 'End Balance',
                'created_at' => '2022-02-07 11:33:17',
                'updated_at' => '2022-02-07 11:33:17',
            ),

              46 => 
            array (
                'id' => 47,
                'model_name' => 'UploadExcel',
                'field_name' => 'invoice_date',
                'view_name' => 'Invoice Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),      47 => 
            array (
                'id' => 48,
                'model_name' => 'UploadExcel',
                'field_name' => 'customer_name',
                'view_name' => 'Customer Name',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 49,
                'model_name' => 'UploadExcel',
                'field_name' => 'invoice_number',
                'view_name' => 'Invoice Number',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 50,
                'model_name' => 'UploadExcel',
                'field_name' => 'invoice_amount',
                'view_name' => 'Invoice Amount',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 51,
                'model_name' => 'UploadExcel',
                'field_name' => 'due_collection_days',
                'view_name' => 'Due Collection Days',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            )
            ,array (
                'id' => 52,
                'model_name' => 'UploadExcel',
                'field_name' => 'due_date',
                'view_name' => 'Due Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            array (
                'id' => 53,
                'model_name' => 'UploadExcel',
                'field_name' => 'contract_code',
                'view_name' => 'Contract / PO Code',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
            array (
                'id' => 54,
                'model_name' => 'UploadExcel',
                'field_name' => 'contract_date',
                'view_name' => 'Contract / PO Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            )
,



            
             
            array (
                'id' => 55,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'invoice_date',
                'view_name' => 'Invoice Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),      
            array (
                'id' => 56,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'supplier_name',
                'view_name' => 'Supplier Name',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 57,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'invoice_number',
                'view_name' => 'Invoice Number',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 58,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'invoice_amount',
                'view_name' => 'Invoice Amount',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),array (
                'id' => 59,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'due_collection_days',
                'view_name' => 'Due Collection Days',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            )
            ,array (
                'id' => 60,
                'model_name' => 'UploadSupplierInvoice',
                'field_name' => 'due_date',
                'view_name' => 'Due Date',
                'created_at' => '2022-02-07 11:32:50',
                'updated_at' => '2022-02-07 11:32:50',
            ),
           

        ));
        
        
    }
}