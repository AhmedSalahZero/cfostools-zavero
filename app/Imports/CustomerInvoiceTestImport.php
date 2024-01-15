<?php

namespace App\Imports;

use App\Models\CustomerInvoiceTest;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


HeadingRowFormatter::default('none');
class CustomerInvoiceTestImport implements
      ToModel,
      WithChunkReading,
      ShouldQueue,
      WithCalculatedFormulas,
      WithHeadingRow,
      WithBatchInserts

{
    public $company_id;
    public $user_id;
    public $format;
    public function __construct($company_id,$user_id,$format)
    {
        $this->company_id = $company_id;
        $this->user_id = $user_id;
        $this->format = $format;


    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new CustomerInvoiceTest([
            'customer_name'                             => $row['Customer Name'],
            'company_id'                                => $this->company_id,
            'business_sector'                           => $row['Business Sector'],
            'invoice_number'                            => $row['Invoice Number'],
            'invoice_date'                              => $this->dateFormatting($row['Invoice Date']),
            'due_within'                                => $row['Due Within'],
            'invoice_due_date'                          => $this->dateFormatting($row['Invoice Due Date']),
            'contract_code'                             => $row['Contract Code'],
            'contract_date'                             => $this->dateFormatting($row['Contract Date']),
            'purchase_order_number'                     => $row['Purchase Order Number'],
            'purchase_order_date'                       => $this->dateFormatting($row['Purchase Order Date']),
            'sales_order_number'                        => $row['Sales Order Number'],
            'sales_order_date'                          => $this->dateFormatting($row['Sales Order Date']),
            'sales_person_name'                         => $row['Sales Person Name'],
            'sales_person_rate'                         => $row['Sales Person Rate'],
            'invoice_amount'                            => $row['Invoice Amount'],
            'currency'                                  => $row['Currency'],
            'advance_payment_amount'                    => $row['Advance Payment Amount'],
            'vat_amount'                                => $row['VAT Amount'],
            'deduction_id_one'                          => $row['Deduction One'],
            'deduction_amount_one'                      => $row['Deduction Amount One'],
            'deduction_id_two'                          => $row['Deduction Two'],
            'deduction_amount_two'                      => $row['Deduction Amount Two'],
            'deduction_id_three'                        => $row['Deduction Three'],
            'deduction_amount_three'                    => $row['Deduction Amount Three'],
            'deduction_id_four'                         => $row['Deduction Four'],
            'deduction_amount_four'                     => $row['Deduction Amount Four'],
            'deduction_id_five'                         => $row['Deduction Five'],
            'deduction_amount_five'                     => $row['Deduction Amount Five'],
            'deduction_id_six'                          => $row['Deduction Six'],
            'deduction_amount_six'                      => $row['Deduction Amount Six'],
            'total_deduction'                           => $row['Total Deduction'],
            'invoice_net_amount'                        => $row['Invoice Net Amount'],
            'invoices_due_notification_days'            => $row['Invoices Due Notification Days'],
            'past_due_invoices_notification_days'       => $row['Past Due Invoices Notification Days'],
            'created_by'                                => $this->user_id,
        ]);
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function dateFormatting($date)
    {
        if(is_numeric($date)){
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
        }else{

            if(str_contains($date,'/')){
                $this->format = str_replace('-','/',$this->format);
            }
            $strtotimeValue = date_create_from_format($this->format,$date);

            $date =  $strtotimeValue->format('Y-m-d');
        }
        return $date;

    }

}
