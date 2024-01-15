<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Repositories\CountryRepository;
use App\Models\Repositories\StateRepository;
use Illuminate\Http\Request;

class UpdateCitiesBasedOnCountryController extends Controller
{

    public function __construct(CountryRepository $countryRepository , StateRepository $stateRepository)
    {
        $this->countryRepository = $countryRepository ;
        $this->stateRepository = $stateRepository ;
    }
    
    public function __invoke(Request $request)
    {
$result = '<option>'.  __('Select') .'</option> ';


        $country = $this->countryRepository->find($request->country_id);

        if($country)
        {
            $states = $country->states()->get();
            $result =  formatSelects($states , $request->selectedItem , $request->model_id , $request->model_value);

        }
        return response()->json([
            'status'=>true ,
            'append_id'=>$request->append_id ,
            'result'=>$result
        ]);
        
    }
}
