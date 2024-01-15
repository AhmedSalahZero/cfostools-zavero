<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInvoiceTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoice_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('business_sector')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('due_within')->nullable();
            $table->string('invoice_due_date')->nullable();
            $table->string('contract_code')->nullable();
            $table->string('contract_date')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->string('purchase_order_date')->nullable();
            $table->string('sales_order_number')->nullable();
            $table->string('sales_order_date')->nullable();
            $table->string('sales_person_name')->nullable();
            $table->decimal('sales_person_rate',10,2)->nullable();
            $table->string('invoice_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('advance_payment_amount')->nullable();
            $table->string('vat_amount')->nullable();
            $table->string('deduction_id_one')->nullable();
            $table->string('deduction_amount_one')->nullable();
            $table->string('deduction_id_two')->nullable();
            $table->string('deduction_amount_two')->nullable();
            $table->string('deduction_id_three')->nullable();
            $table->string('deduction_amount_three')->nullable();
            $table->string('deduction_id_four')->nullable();
            $table->string('deduction_amount_four')->nullable();
            $table->string('deduction_id_five')->nullable();
            $table->string('deduction_amount_five')->nullable();
            $table->string('deduction_id_six')->nullable();
            $table->string('deduction_amount_six')->nullable();
            $table->string('total_deduction')->nullable();
            $table->string('invoice_net_amount')->nullable();
            $table->string('invoices_due_notification_days')->nullable();
            $table->string('past_due_invoices_notification_days')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
            $table->json('validation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_invoice_tests');
    }
}
