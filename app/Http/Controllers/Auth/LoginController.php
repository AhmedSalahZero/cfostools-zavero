<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
		// if(in_array(trim(Request()->get('email')),excludeUsers())){
		// 	$company = User::where('email',Request()->get('email'))->first()->companies->first();
		// 	return route('admin.view.hospitality.sector',['company'=>$company->id]);
		// }
        return route('home');
    }
    protected function authenticated(Request $request, $user)
    {
    
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
