<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Models\Company;
use App\Models\TablesField;
use App\Models\UploadExcel;
use App\Models\UploadSupplierInvoice;
use Illuminate\Http\Request;

class UploadSupplierInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        // dd('e');
        $uploadSupplierInvoices = UploadSupplierInvoice::company()->orderBy('date','desc')->paginate(50);
        $exportableFields  = (new ExportTable)->customizedTableField($company, 'UploadSupplierInvoice', 'selected_fields');
        $viewing_names = array_values($exportableFields);
        $db_names = array_keys($exportableFields);
        return view('client_view.upload_suppliers_invoices.index', compact('uploadSupplierInvoices','company','viewing_names','db_names'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        $customerInvoice = new SalesGatheringViewModel($company);

        return view('client_view.upload_excels.form', $customerInvoice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Company $company)
    {
        // $request['company_id'] = $company->id;
        UploadExcel::create($request->all());
        return redirect()->back();
    }


    public function edit(Company $company,UploadExcel $uploadExcel)
    {

        $uploadExcel  = new SalesGatheringViewModel($company,$uploadExcel);

        return view('client_view.upload_excels.form',   $uploadExcel);
    }


    public function update(Request $request,Company $company, UploadExcel $uploadExcel)
    {

        $uploadExcel->update($request->all());
        toastr()->success('Updated Successfully');
        return (new SalesGatheringViewModel($company,$uploadExcel))->view('client_view.upload_excels.form');
    }


    public function destroy(Company $company, UploadExcel $uploadExcel)
    {
        // dd($uploadExcel);
        toastr()->error('Deleted Successfully');
        $uploadExcel->delete();
        return redirect()->back();
    }
    public function export(Company $company)
    {
        $exportableFields = exportableFields($company->id,'UploadExcel');
        // If there are no exportable fields were found return with a warning msg
        if ($exportableFields === null) {
            toastr()->warning('Please choose exportable fields first');
            return redirect()->back() ;
        }
        // Get The Selected exportable fields returns a pair of ['field_name' => 'viewing name']
        $selected_fields = (new ExportTable)->customizedTableField($company, 'UploadExcel', 'selected_fields');
        // Array Contains Only the name of fields
        $exportable_fields = array_keys($selected_fields);
        $uploadExcel = UploadExcel::where('company_id',$company->id)->get();
        // Customizing the collection to be exported
        $uploadExcel = collect($uploadExcel)->map(function ($invoice)use($exportable_fields){
            $data = [];
            foreach ($exportable_fields as $field) {
                if (str_contains($field,'deduction_id_')) {
                    $value = Deduction::find($invoice->$field)->name[lang()] ??null;
                }elseif (str_contains($field,'date')) {
                    $value = $invoice->$field ===null ?: date('d-m-Y',strtotime($invoice->$field));
                } else{
                    $value = $invoice->$field;
                }
                $data[$field] = $value ;
            }
            return $data;
        });

        return (new ExportData($company->id,array_values($selected_fields),$uploadExcel))->download('UploadExcel.xlsx');

    }
}
