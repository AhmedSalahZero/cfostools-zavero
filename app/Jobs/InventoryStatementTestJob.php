<?php

namespace App\Jobs;

use App\Models\CustomersInvoice;
use App\Models\Deduction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\CustomerInvoiceTestImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InventoryStatementTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->invoices as $invoice) {
            $invoice = collect($invoice);
            $invoice_to_be_inserted = $invoice->toArray();
            unset($invoice_to_be_inserted['id']);

            $validator = Validator::make($invoice_to_be_inserted, [
                // 'supplier_name' => 'required',
            ]);

            if ($validator->fails()) {
                DB::table('inventory_statement_tests')
                ->where('id', $invoice['id'])
                ->update(['validation'=>$validator->errors()->all()]);
            }else{
                unset($invoice_to_be_inserted["validation"]);

                DB::table('inventory_statements')->insert($invoice_to_be_inserted);
                DB::delete('delete from inventory_statement_tests where id = ?', [$invoice['id']]);
            }
        }

    }
}
