<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\ProductionUnitOfMeasurement;
use App\Models\SellingUnitOfMeasurement;
use App\Traits\ImageSave;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('super_admin_view.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin_view.companies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        toastr()->success('Created Successfully');
        $companySection = Company::create($request->except('image'));
		foreach(getDefaultSellingUOM() as $defaultSellingUnitArr){
			SellingUnitOfMeasurement::create([
				'name'=>$defaultSellingUnitArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		foreach(getDefaultProductionUOM() as $defaultProductionUnitArr){
			ProductionUnitOfMeasurement::create([
				'name'=>$defaultProductionUnitArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		
		foreach(getDefaultCurrencies() as $currencyArr){
			Currency::create([
				'name'=>$currencyArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		
		
		
        ImageSave::saveIfExist('image',$companySection);



        return redirect()->back();
    }
    public function adminCompany(Request $request,$company_id)
    {
        $company_row = Company::findOrFail($company_id);
        if ($request->method() == 'GET') {
            return view('super_admin_view.companies.form',compact('company_row'));
        }elseif ($request->method() == "POST") {
            $request['sub_of'] = $company_id;
            $request['type'] = 'single';

            $companySection = Company::create($request->except('image'));
            ImageSave::saveIfExist('image',$companySection);
            (new BranchController)->createMainBrach($companySection->id);
            toastr()->success('Created Successfully');
            return redirect()->back();
        }

    }

    public function editAdminCompany(Request $request,$company_id,Company $companySection)
    {
        $company_row = Company::findOrFail($company_id);


        if ($request->method() == 'GET') {
            return view('super_admin_view.companies.form',compact('company_row','companySection'));
        }else {
            $companySection->update($request->except('image'));
            ImageSave::saveIfExist('image',$companySection);
            toastr()->success('Updated Successfully');
            return redirect()->back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $companySection)
    {
        return view('super_admin_view.companies.form',compact('companySection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $companySection)
    {
		SellingUnitOfMeasurement::where('company_id',$companySection->id )->delete();
		foreach(getDefaultSellingUOM() as $defaultSellingUnitArr){
			SellingUnitOfMeasurement::create([
				'name'=>$defaultSellingUnitArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		ProductionUnitOfMeasurement::where('company_id',$companySection->id)->delete();
		foreach(getDefaultProductionUOM() as $defaultProductionUnitArr){
			ProductionUnitOfMeasurement::create([
				'name'=>$defaultProductionUnitArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		Currency::where('company_id',$companySection->id)->delete();
		foreach(getDefaultCurrencies() as $currencyArr){
			Currency::create([
				'name'=>$currencyArr['title'],
				'company_id'=>$companySection->id 
			]);
		}
		
        toastr()->success('Updated Successfully');
        $companySection->update($request->except('image'));
        ImageSave::saveIfExist('image',$companySection);
        toastr()->success('Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $companySection)
    {
        toastr()->error('Deleted Successfully');
        $companySection->delete();
        return redirect()->back();
    }
}
