@extends('layouts.dashboard')
@section('css')
<link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<style>
    table {
        white-space: nowrap;
    }
	
	
	
	

    html body .kt-list-timeline__items .kt-portlet__body .card div.card-title:not(.collapsed) {
        background-color: #046187 !important;
        color: white !important;
    }

    .card-title span {
        font-size: 22px !important;
    }

    .card-title.collapsed span {
        color: #366cf3 !important;
    }

    .card-title.collapsed i,
    .card-title.collapsed::after {
        color: #366cf3 !important
    }

    .card-title:not(.collapsed) i,
    .card-title:not(.collapsed)::after,
    .card-title:not(.collapsed) span {
        color: white !important;
    }
	
	

</style>
@endsection
@section('sub-header')
<h1 class="kt-infobox__title" style="color: white">{{__("WELCOME TO  ".$company->name['en']." COMPANY") }}</h1>
<div class="kt-infobox__content" style="color: white">
    {{__("IT IS NOT ABOUT NUMBERS, IT IS ABOUT THE STORY BEHIND THE NUMBERS")}}
</div>
@endsection

@section('content')

{{-- Title --}}
{{-- <div class="row">
    <div class="kt-portlet ">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title head-title text-center text-primary">
                    {{"Welcome To ".$company->name['en']." Company"}}
</h1>
</div>
</div>
</div>
</div> --}}
{{-- <div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="kt-infobox">
            <div class="kt-infobox__body">
                <div class="kt-infobox__section" style="text-align: center">
                    <h1 class="kt-infobox__title">{{__("WELCOME TO  ".$company->name['en']." COMPANY") }}</h1>
<div class="kt-infobox__content">
    {{__("IT IS NOT ABOUT NUMBERS, IT IS ABOUT THE STORY BEHIND THE NUMBERS")}}
</div>
</div>
</div>
</div>
</div>

</div> --}}

<div class="row" id="first_card">

    <div class="kt-portlet kt-iconbox kt-iconbox--animate">
        <div class="kt-portlet__body">
            <div class="kt-iconbox__body">
                <div class="kt-iconbox__desc">
                    <h3 class="kt-iconbox__title"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                            </g>
                        </svg> {{ __('Where You Want To Go :') }}
                    </h3>
                    <br><br>
                    <div class="kt-iconbox__content d-flex align-items-start flex-column">
                        <div class="kt-list-timeline__items">



                            <div class="kt-portlet__body">
                                <div class="kt-list-timeline">
                                    <div class="accordion  accordion-toggle-arrow" id="planningSectionId">
                                        <div class="card">
                                            <div class="card-header" id="headingOne44">
                                                <div class="card-title" data-toggle="collapse" data-target="#collapsePlanningSectionId" aria-expanded="true" aria-controls="collapseOne44">
                                                    <i class="flaticon2-layers-1"></i> {{ __('Feasibilities & Financial Planning Section') }}
                                                </div>
                                            </div>
                                            <div id="collapsePlanningSectionId" class="collapse show" aria-labelledby="headingOne" data-parent="#planningSectionId">
                                                <div class="card-body with-padding">
													<x-quick-nav :link="route('admin.view.hospitality.sector',$company->getIdentifier())">{{ __('Hotel Feasibility & Valuation') }}</x-quick-nav>
                                                    	@if(!in_array(Auth()->user()->email,excludeUsers()))
													<x-quick-nav :link="route('admin.view.fb',$company->getIdentifier())">{{ __('Food & Beverage Outlets Feasibility & Valuation') }}</x-quick-nav>
                                                    <x-quick-nav :link="route('admin.view.win.quotation',$company->getIdentifier())">{{ __('Annual Budgets') }}</x-quick-nav>
													@endif 
											    </div>
                                            </div>
                                        </div>
										
										
										
										
										@if(!in_array(Auth()->user()->email,excludeUsers()))
										<div class="card">
                                            <div class="card-header" id="pricingCalculatorSection">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsePricingCalculatorSection" aria-expanded="true" aria-controls="collapseOne4">
                                                    <i class="flaticon2-layers-1"></i> {{ __('Pricing & Quotations Section') }}
                                                </div>
                                            </div>
                                            <div id="collapsePricingCalculatorSection" class="collapse" aria-labelledby="headingOne" data-parent="#pricingCalculatorSection">
                                                <div class="card-body with-padding">
                                                    <x-quick-nav :link="route('admin.view.quick.pricing.calculator',$company->getIdentifier())">{{ __('Quick Pricing Calculator') }}</x-quick-nav>
                                                    <x-quick-nav :link="route('admin.view.all.quotation',$company->getIdentifier())">{{ __('View Quotations') }}</x-quick-nav>
                                                    <x-quick-nav :link="route('admin.view.win.quotation',$company->getIdentifier())">{{ __('Win Quotation') }}</x-quick-nav>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="analysisSectionId">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseAnalysisSectionId" aria-expanded="false" aria-controls="collapseTwo4">
                                                    <i class="flaticon2-copy"></i> {{ __("Performance Analysis Section") }}
                                                </div>
                                            </div>
                                            <div id="collapseAnalysisSectionId" class="collapse" aria-labelledby="headingTwo1" data-parent="#analysisSectionId">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
										@endif 
                                        <div class="card">
                                            <div class="card-header" id="loanCalculatorId">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseLoanCalculatorId" aria-expanded="false" aria-controls="collapseThree4">
                                                    <i class="flaticon2-bell-alarm-symbol"></i> {{ __("Loan Calculator") }}
                                                </div>
                                            </div>
                                            <div id="collapseLoanCalculatorId" class="collapse" aria-labelledby="headingThree1" data-parent="#loanCalculatorId">
                                                <div class="card-body">
                                                    <div class="card-body with-padding">
                                                        <x-quick-nav :link="route('fixed.loan.fixed.at.end',$company->getIdentifier())">{{ __('Fixed Payments At The End') }}</x-quick-nav>
                                                        <x-quick-nav :link="route('fixed.loan.fixed.at.beginning',$company->getIdentifier())">{{ __('Fixed Payments At The Begining') }}</x-quick-nav>
                                                        <x-quick-nav :link="route('calc.loan.amount',$company->getIdentifier())">{{ __('Calculate Loan Amount') }}</x-quick-nav>
                                                        <x-quick-nav :link="route('calc.interest.percentage',$company->getIdentifier())">{{ __('Calculate Interest Percentage') }}</x-quick-nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										@if(Auth()->user()->id ==1)
										 <div class="card">
                                            <div class="card-header" id="collapseLoanCalculatorIdphp">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseLoanCalculatorIdphp" aria-expanded="false" aria-controls="collapseThree4">
                                                    <i class="flaticon2-bell-alarm-symbol"></i> {{ __("Loan Calculator[PHP]") }}
                                                </div>
                                            </div>
                                            <div id="collapseLoanCalculatorIdphp" class="collapse" aria-labelledby="headingThree1" data-parent="#collapseLoanCalculatorIdphp">
                                                <div class="card-body">
                                                    <div class="card-body with-padding">
                                                        <x-quick-nav :link="route('fixed.loan.fixed.at.end.php',$company->getIdentifier())">{{ __('Fixed Payments At The End') }}</x-quick-nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										@endif 
										
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <div class="kt-widget6__action kt-align-left" >
                    <a href="#" onclick="return false;"   id="skip" class="btn btn-outline-info"><b>Skip</b></a>
                </div> --}}
            </div>
        </div>
        {{-- </div> --}}
    </div>
    <div class="row" style="display: none" id="second_card">
        {{-- <div class="col-2"></div>
    <div class="col-8" > --}}
        <div class="kt-portlet kt-iconbox kt-iconbox--animate">
            <div class="kt-portlet__body">
                <div class="kt-iconbox__body">
                    <div class="kt-iconbox__desc">
                        <h3 class="kt-iconbox__title"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                                </g>
                            </svg>
                            Please choose where do you want to go?
                        </h3>
                        <br><br>
                        <div class="kt-iconbox__content d-flex align-items-start flex-column">
                            {{-- <ul class="mb-auto p-2">
                                <li> <h4> {{ __("Sales Dashboard") }} <a href="{{ route('dashboard', $company) }}" class="btn btn-label-info btn-pill"> <b>Go</b></a> </h4>
                            </li>
                            <li>
                                <h4> {{ __("Sales Breakdown Analysis") }} <a href="{{route('sales.breakdown.analysis',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a> </h4>
                            </li>
                            <li>
                                <h4> {{ __("Sales Trend Analysis") }} <a href="{{route('sales.trend.analysis',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a> </h4>
                            </li>
                            <li>
                                <h4> {{ __("Sales Report") }} <a href="{{route('salesReport.view',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a> </h4>
                            </li>
                            </ul> --}}



                            <div class="kt-portlet__body">
                                <div class="kt-list-timeline">
                                    <div class="kt-list-timeline__items">

                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text">
                                                <h4> {{ __("Sales Dashboard") }} </h4>
                                            </span>
                                            <span class="kt-list-timeline__time"><a href="{{ route('dashboard', $company) }}" class="btn btn-label-info btn-pill"> <b>Go</b></a></span>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- <div class="kt-list-timeline__items">

                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"> <h4> {{ __("Sales Breakdown Analysis") }} </h4></span>
                                    <span class="kt-list-timeline__time"> <a href="{{route('sales.breakdown.analysis',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a></span>
                                </div>
                            </div> --}}
                            {{-- <br>
                                    <div class="kt-list-timeline__items">

                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"> <h4> {{ __("Sales Trend Analysis") }} </h4></span>
                            <span class="kt-list-timeline__time"> <a href="{{route('sales.trend.analysis',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a></span>
                        </div>
                    </div> --}}
                    {{-- <br>
                                    <div class="kt-list-timeline__items">

                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"> <h4> {{ __("Sales Report") }} </h4></span>
                    <span class="kt-list-timeline__time"><a href="{{route('salesReport.view',$company)}}" class="btn btn-label-info btn-pill"><b>Go</b></a></span>
                </div>
            </div> --}}
        </div>
    </div>


</div>

</div>
</div>

</div>
</div>
{{-- </div> --}}
</div>










{{-- <div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Timeline List <small>state colors</small>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!--begin::Timeline 1-->
        <div class="kt-list-timeline">
            <div class="kt-list-timeline__items">

                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                    <span class="kt-list-timeline__text">System error occured and hard drive has been shutdown - <a href="#" class="kt-link">Check</a></span>
                    <span class="kt-list-timeline__time">2 hrs</span>
                </div>
            </div>
        </div>


    </div>
</div> --}}



































@endsection
@section('js')
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
</script>
<script>
    $(function() {
        $('#skip').on('click', function(e) {
            e.preventDefault();
            $('#first_card').fadeOut("slow", function() {
                $('#second_card').fadeIn(500);
            });
        });

    })

</script>
<!-- Resources -->

@endsection
