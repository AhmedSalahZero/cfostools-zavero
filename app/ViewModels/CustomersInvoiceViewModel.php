<?php

namespace App\ViewModels;

use App\Models\Company;
use App\Models\Deduction;
use App\Models\CustomersInvoice;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;
use App\Http\Controllers\CustomersInvoiceController;
use App\Models\ToolTipData;

class CustomersInvoiceViewModel extends ViewModel
{


    public $customerInvoice;
    public $company;

    public $indexUrl = null;

    public function __construct(Company $company, CustomersInvoice $customerInvoice = null)
    {

        $this->company = $company;
        $this->customerInvoice = $customerInvoice;

        $this->indexUrl = action([CustomersInvoiceController::class, 'index'],$this->company);
    }

    public function customerInvoice(): CustomersInvoice
    {

        return $this->customerInvoice ?? new CustomersInvoice();
    }
    public function deductions(): Collection
    {
        return  Deduction::all();
    }
    public function toolTipsData(): Collection
    {
        return  ToolTipData::where('model_name','CustomersInvoice')->get();
    }

}
