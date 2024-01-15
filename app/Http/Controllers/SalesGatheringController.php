<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Models\Company;
use App\Models\SalesGathering;
use App\Models\TablesField;
use Illuminate\Http\Request;

class SalesGatheringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        // dd('x');
        
        // $salesGatherings = SalesGathering::company()->orderBy('date','desc')->get;
        $salesGatherings = SalesGathering::company()->orderBy('date','desc')->paginate(50);
        $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
        $viewing_names = array_values($exportableFields);
        $db_names = array_keys($exportableFields);
        return view('client_view.sales_gathering.index', compact('salesGatherings','company','viewing_names','db_names'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        $customerInvoice = new SalesGatheringViewModel($company);

        return view('client_view.sales_gathering.form', $customerInvoice);
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
        SalesGathering::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesGathering  $salesGathering
     * @return \Illuminate\Http\Response
     */
    public function show(SalesGathering $salesGathering )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesGathering  $salesGathering
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company,SalesGathering $salesGathering)
    {

        $salesGathering  = new SalesGatheringViewModel($company,$salesGathering);

        return view('client_view.sales_gathering.form',   $salesGathering);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesGathering  $salesGathering
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company, SalesGathering $salesGathering)
    {

        $salesGathering->update($request->all());
        toastr()->success('Updated Successfully');
        return (new SalesGatheringViewModel($company,$salesGathering))->view('client_view.sales_gathering.form');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesGathering  $salesGathering
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, SalesGathering $salesGathering)
    {
        toastr()->error('Deleted Successfully');
        $salesGathering->delete();
        return redirect()->back();
    }
    public function export(Company $company)
    {
        $exportableFields = exportableFields($company->id,'SalesGathering');
        // If there are no exportable fields were found return with a warning msg
        if ($exportableFields === null) {
            toastr()->warning('Please choose exportable fields first');
            return redirect()->back() ;
        }
        // Get The Selected exportable fields returns a pair of ['field_name' => 'viewing name']
        $selected_fields = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
        // Array Contains Only the name of fields
        $exportable_fields = array_keys($selected_fields);
        $salesGathering = SalesGathering::where('company_id',$company->id)->get();
        // Customizing the collection to be exported
        $salesGathering = collect($salesGathering)->map(function ($invoice)use($exportable_fields){
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

        return (new ExportData($company->id,array_values($selected_fields),$salesGathering))->download('SalesGatherings.xlsx');

    }
}
