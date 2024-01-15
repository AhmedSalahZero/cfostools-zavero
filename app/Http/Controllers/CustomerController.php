<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\StoreSharingLinkRequest;
use App\Http\Requests\UpdateSharingLinkRequest;
use App\Models\Repositories\CustomerRepository;
use App\Models\Repositories\SharingLinkRepository;
use App\Models\SharingLink;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerRepository $customerRepository ;
    
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository ; 
    }
    public function index()
    {
        // return view('admin.sharing-links.view' , SharingLink::getViewVars());
    }

     public function paginate(Request $request)
    {
        // return $this->sharingLinkRepository->paginate($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(CustomerRequest $request)
    {
        $customer = $this->customerRepository->store($request);
        return response()->json([
            'status'=>true ,
            'id'=>$customer->id ,
            'name'=>$customer->getNameAndType()
        ]);
    }
    public function toggleSharingLinkStatus(Request $request )
    {
        $shareableLink = $this->sharingLinkRepository->find($request->get('sharing_id'));
        if($shareableLink)
        {
            $shareableLink->toggleActivation();
        }

        return response()->json([
            'status'=>true 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SharingLink  $sharingLink
     * @return \Illuminate\Http\Response
     */
    public function show(SharingLink $sharingLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SharingLink  $sharingLink
     * @return \Illuminate\Http\Response
     */
    public function edit(SharingLink $sharingLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSharingLinkRequest  $request
     * @param  \App\Models\SharingLink  $sharingLink
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSharingLinkRequest $request, SharingLink $sharingLink)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SharingLink  $sharingLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(SharingLink $sharingLink)
    {
        //
    }
}
