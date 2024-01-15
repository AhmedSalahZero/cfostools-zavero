<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageSave;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function freeSubscription(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request,[

                'name' => ['required', 'string', 'max:255'],
                'company_name' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'avatar' =>  'required' ,
                'company_avatar' =>  'required' ,
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $request['password'] = Hash::make($request->password);

            $dt = Carbon::parse(date('Y-m-d'));
            $expiration_date = $dt->addDays(30)->format('Y-m-d');

            $user = User::create($request->except('avatar'));
            $user->subscription = "free_trial";
            $user->expiration_date = $expiration_date;
            $user->save();

            ImageSave::saveIfExist('avatar',$user);

            $companySection = Company::create(['name' => $request->company_name]);
            ImageSave::saveIfExist('company_avatar',$companySection);

            $user->companies()->attach($companySection->id);

            Auth::login($user, $remember = true);

            return redirect()->route('home');

        }else{

            return view('free_subscription.form');
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('super_admin_view.users.index',compact('users') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('super_admin_view.users.form',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['password'] = Hash::make($request->password);
        $request['subscription'] = 'subscripted';
        $user = User::create($request->except('avatar','companies'));
        $user->companies()->attach($request->companies);
        $user->assignRole($request->role);
        ImageSave::saveIfExist('image',$user);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $companies = Company::all();

        return view('super_admin_view.users.form',compact('companies','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request['password'] = Hash::make($request->password);
        $user->update($request->except('avatar','companies'));
        $user->companies()->sync($request->companies);
        @count($user->roles) == 0 ?: $user->removeRole($user->roles[0]->name) ;

        $user->assignRole($request->role);
        ImageSave::saveIfExist('avatar',$user);
        return redirect()->back();
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
