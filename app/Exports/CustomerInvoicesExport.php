<?php

namespace App\Exports;

use App\Models\CustomersInvoice;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
class CustomerInvoicesExport implements  FromQuery  , WithMapping  ,WithHeadings
// , ShouldQueue
{
    use Exportable;

    public $company_id;
    public $heads;

    public function __construct($company_id,$heads=[],$withData=true){
        $this->company_id = $company_id;
        $this->heads = $heads;
    }

    public function query()
    {
        return $this->withData ? CustomersInvoice::query()->where('company_id',$this->company_id) : CustomersInvoice::query();
    }

    /**
    * @var CustomersInvoice $invoice
    */
    // To customize the data from query
    public function map($invoice): array
    {
        return  [
            $invoice->customer_name,
            $invoice->business_sector,
            $invoice->invoice_number,
            $invoice->invoice_date,
            $invoice->due_within,
            $invoice->invoice_due_date,
            $invoice->contract_code,
            $invoice->contract_date,
            $invoice->purchase_order_number,
            $invoice->purchase_order_date,
            $invoice->sales_order_number,
            $invoice->sales_order_date,
            $invoice->sales_person_name,
            $invoice->sales_person_rate,
            $invoice->invoice_amount,
            $invoice->currency,
            $invoice->advance_payment_amount,
            $invoice->vat_amount,
            $invoice->deductionName('deduction_id_one'),
            $invoice->deduction_amount_one,
            $invoice->deductionName('deduction_id_two'),
            $invoice->deduction_amount_two,
            $invoice->deductionName('deduction_id_three'),
            $invoice->deduction_amount_three,
            $invoice->deductionName('deduction_id_four'),
            $invoice->deduction_amount_four,
            $invoice->deductionName('deduction_id_five'),
            $invoice->deduction_amount_five,
            $invoice->deductionName('deduction_id_six'),
            $invoice->deduction_amount_six,
            $invoice->total_deduction,
            $invoice->invoice_net_amount,
            $invoice->invoices_due_notification_days,
            $invoice->past_due_invoices_notification_days
        ];
    }
    // Headings Names
    public function headings(): array
    {

        return $this->heads;
    }

}
