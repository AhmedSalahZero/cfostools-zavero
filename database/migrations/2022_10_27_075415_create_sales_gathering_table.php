<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesGatheringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_gathering', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('Year')->nullable()->index('Year');
            $table->integer('Month')->nullable()->index('Month');
            $table->integer('Day')->nullable()->index('Day');
            $table->string('country', 191)->nullable();
            $table->string('local_or_export', 191)->nullable();
            $table->string('branch', 50)->nullable();
            $table->string('document_type', 191)->nullable();
            $table->string('document_number', 191)->nullable();
            $table->string('sales_person', 50)->nullable();
            $table->string('customer_code', 191)->nullable();
            $table->string('customer_name', 100)->nullable();
            $table->string('business_sector', 50)->nullable();
            $table->string('zone', 100)->nullable();
            $table->string('sales_channel', 100)->nullable();
            $table->string('service_provider_type', 50)->nullable();
            $table->string('service_provider_name', 50)->nullable();
            $table->integer('service_provider_birth_year')->nullable();
            $table->string('principle', 191)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('sub_category', 191)->nullable();
            $table->string('product_or_service', 50)->nullable();
            $table->string('product_item', 100)->nullable();
            $table->string('measurment_unit', 191)->nullable();
            $table->string('return_reason', 191)->nullable();
            $table->decimal('quantity', 20, 4)->nullable();
            $table->string('quantity_status', 191)->nullable();
            $table->decimal('quantity_bonus', 20, 4)->nullable();
            $table->decimal('price_per_unit', 20, 4)->nullable();
            $table->decimal('sales_value', 20, 4)->nullable();
            $table->decimal('quantity_discount', 20, 4)->nullable();
            $table->decimal('cash_discount', 20, 4)->nullable();
            $table->decimal('special_discount', 20, 4)->nullable();
            $table->decimal('other_discounts', 20, 4)->nullable();
            $table->decimal('net_sales_value', 20, 4)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->string('created_by', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('min_year')->nullable();
            $table->string('prev_year', 10)->nullable();

            $table->index(['company_id', 'customer_name', 'zone', 'net_sales_value', 'Year'], 'min__index_zone');
            $table->index(['company_id', 'branch', 'zone', 'business_sector', 'sales_channel', 'product_or_service', 'category', 'product_item', 'date', 'service_provider_type', 'service_provider_birth_year', 'service_provider_name'], 'break_down_types');
            $table->index(['company_id', 'sales_channel', 'date', 'net_sales_value', 'service_provider_name', 'id'], 'sales_channel_index');
            $table->index(['zone', 'sales_channel'], 'sales_gathering_zone_sales');
            $table->index(['product_or_service', 'company_id'], 'IX__product_or_service_index');
            $table->index(['product_item', 'company_id'], 'IX__product_item_index');
            $table->index(['branch', 'company_id'], 'IX__branch_index');
            $table->index(['company_id', 'customer_name', 'product_item', 'net_sales_value', 'Year'], 'min__index_product_item');
            $table->index(['zone', 'company_id'], 'zones_index');
            $table->index(['Year', 'Month', 'Day'], 'sales_gathering');
            $table->index(['company_id', 'customer_name', 'category', 'net_sales_value', 'Year'], 'min__index_category');
            $table->index(['business_sector', 'company_id'], 'IX__business_sector_index');
            $table->index(['company_id', 'customer_name', 'business_sector', 'net_sales_value', 'Year'], 'min__index_business_sector');
            $table->index(['sales_channel', 'company_id'], 'IX__sales_channel_index');
            $table->index(['sales_person', 'company_id'], 'IX__sales_person_index');
            $table->index(['company_id', 'customer_name', 'branch', 'net_sales_value', 'Year'], 'min__index_branch');
            $table->index(['category', 'company_id'], 'IX__category_index');
            $table->index(['company_id', 'customer_name', 'product_or_service', 'net_sales_value', 'Year'], 'min__index_product_or_service');
            $table->index(['company_id', 'customer_name', 'sales_channel', 'net_sales_value', 'Year'], 'min__index_sales_channel');
            $table->index(['customer_name', 'Year', 'company_id', 'net_sales_value'], 'min__index');
            $table->index(['company_id', 'customer_name', 'sales_person', 'net_sales_value', 'Year'], 'min__index_sales_person');
            $table->index(['Year'], 'Year_2');
            $table->index(['company_id', 'customer_name', 'country', 'net_sales_value', 'Year'], 'min__index_country');
            $table->index(['company_id', 'date', 'Year', 'Month', 'net_sales_value'], 'interval__index');
            $table->index(['date', 'sales_person', 'product_item', 'product_or_service', 'customer_name'], 'sales_gathering_customer_index');
            $table->index(['net_sales_value', 'date', 'customer_name', 'company_id'], 'commin_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_gathering');
    }
}
