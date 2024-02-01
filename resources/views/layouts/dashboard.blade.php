<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="../">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>
        {{ env('APP_NAME') }}
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <!--begin::Fonts -->
	<style>
	.visibility-hidden{
		  visibility: hidden;

	}
	.menu-height{
		height:70vh !important;
	}
	</style>
    <script>
        function number_unformat(formattedNumber) {

            if (formattedNumber == 'NaN' || typeof formattedNumber === "undefined" || !formattedNumber.replace) {
                return 0;
            }
            return formattedNumber.replace(/(<([^>]+)>)/gi, "").replace(/,/g, "")
        }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        var wto;

        function formatDate(date) {
            var d = new Date(date)
                , month = '' + (d.getMonth() + 1)
                , day = '' + d.getDate()
                , year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [month, day, year].join('/');
        }

        function getNumberOfMillSeconds() {
            return 2000;
        }

        function reinitializeSelect2() {



            $(document).find('select.select2-select').each(function(index, value) {
                // alert('good')
                if($(this).selectpicker){
				$(this).selectpicker({
                    buttons: ['selectMax', 'disableAll']
                });
					
				}

            })

        }

    </script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700"]
            }
            , active: function() {
                sessionStorage.fonts = true;
            }
        });

    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="{{url('assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{url('assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{url('assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{url('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{url('assets/css/demo4/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/global.css')}}" rel="stylesheet" type="text/css" />
	
	
    <style>
	
	
.income-statement-table{
}
.btn-border-radius{
        border-radius:10px !important;
    }
	
.income-statement-table .main-level-tr td ,
.income-statement-table .main-level-tr th
{
    background-color:#9FC9FB !important ;
    border:1px solid #fff ;
    
}
.income-statement-table .main-level-tr td:first-of-type ,
.income-statement-table .main-level-tr td:nth-of-type(2) ,
.income-statement-table .main-level-tr th:first-of-type,
.income-statement-table .main-level-tr th:nth-of-type(2)
{
    background-color:#9FC9FB !important;
}
.income-statement-table .sub-level-tr td ,
.income-statement-table .sub-level-tr th
{
    background-color:#fff !important ;
}
        input,
        select,
        .filter-option-inner-inner {
            font-weight: 600 !important;
            color: black !important;
        }

        html body tr.all-td-white td {
            background-color: white !important;
        }

        .font-size-1-25rem {
            font-size: 1.25rem !important;
        }

        .font-size-15px {
            font-size: 15px !important
        }

        .label-clr {
            color: #646c9a !important;
        }

        .installment-section {
            background: #F2F2F2 !important;
            padding-top: 10px;
            margin-bottom: 10px !important;
        }

        .label-size {
            font-size: 1.25rem !important;
        }

        .pr-6rem {
            padding-right: 6rem;
        }

        .pointer-events-none {
            pointer-events: none;
        }

        .dtfh-floatingparent.dtfh-floatingparenthead {
            top: 59px !important;
        }

        .table-for-collection-policy tr:nth-child(odd) {
            background-color: white !important;
        }

        .percentage-weight {
            font-weight: bold;
            margin-right: 10px;
        }

        .three-dots-column {
            flex-direction: row !important;
        }

        html body i:not([data-repeating-direction="column"]) {
            color: #055dac !important;
        }
		html body .repeater-class i:not([data-repeating-direction="column"]) {
            color: white !important;
        }
		
        i[data-repeating-direction="column"] {
            transform: rotate(90deg);
            margin-top: 3px;
            position: absolute;
            color: #78c35e;
            margin-left: 0 !important;
        }

        input.form-control[readonly] {
            background-color: #CCE2FD !important;
            font-weight: bold !important;
        }

        .small-caps {
            font-variant: small-caps;
        }

        .sharing-sign {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: auto;
        }

        .active-sharing {
            background: #00ff28;
        }

        .inactive-sharing {
            background: #f00;
        }

        .w-full {
            width: 100%;
        }

        .btn.dropdown-toggle {
            height: 100%;
        }

        /* .dropdown-toggle{} */

    </style>
    <style>
        .custom--i-class-parent {
            position: relative;
            padding-left: 20px;
            padding-right: 20px;
        }

        .custom--i-class {
            margin-top: 0 !important;
            position: absolute !important;
            top: 50%;
            left: 7px !important;
            transform: rotate(90deg) translateY(-50%) !important;
            float: none !important;
        }

        .custom-i-class {
            position: absolute !important;
            left: -15px !important;
            top: 13px !important;
        }

        .icon-lg {
            font-size: 1.75rem !important;
        }

        .min-height-170px {
            min-height: 170px;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .first-subrow-last-td,
        .second-subrow-last-td {
            text-align: right;
        }

        .font-weight-bold {
            font-weight: bold !important;
        }


        .subtable-2-class {}

        .subtable-1-class {}

        .custom-export {
            z-index: 5;
            border-radius: 6px;
            background-color: #fff;
            position: relative;
            right: 163px;
            position: fixed !important;
            top: 276px;
            box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.1);
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            width: 300px;
            padding-bottom: 20px;


        }

        @media(max-width:767px) {
            .custom-export {
                z-index: 5;
                background-color: #fff;
                right: 30px;
                position: fixed !important;
                top: 215px;
                box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.1);
                width: 300px;
                width: 200px;
            }
        }

        @media (min-width: 768px) {
            .custom-export {
                width: 325px;
            }
        }

    </style>
    <style>
        .table-striped th,
        .table-striped2 th {
            background-color: #074DA5 !important;
            color: #fff !important;
            vertical-align: middle !important;
            border: #074DA5;
            text-align: center;
        }

        .table-striped td:first-child,
        .table-striped td,
        .table-striped2 td:first-child {
            text-align: center;
        }

        .table-striped td,
        .table-striped2 td {
            border: 0px;
        }

        .table-striped td .btn {
            padding: 0px;
            width: fit-content !important;
        }

    </style>
    @if(isLoanRoute())
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

    @else
    <link href="{{url('datatable/datatable.css')}}" rel="stylesheet" type="text/css" />
    @endif

    <!--end::Global Theme Styles -->
    <style>
        #DataTables_Table_1_info,
        .dataTables_empty,
        #DataTables_Table_1_paginate,
        #DataTables_Table_1_filter,
        #DataTables_Table_1_length {
            display: none !important;
        }

        .dtfc-fixed-right {
            right: 0 !important
        }

        table.dataTable tbody tr.group-color>.dtfc-fixed-right,
        table.dataTable tbody tr.group-color>.dtfc-fixed-right {
            right: 0 !important;
            background-color: #086691 !important;

        }

        .dataTables_scrollBody::-webkit-scrollbar {}

        .dataTables_scrollBody {}




        .dtfc-fixed-right {}

        #to__left:hover {}

        #scroll-fixed {
            display: none;
        }

        .kt-portlet.kt-portlet--tabs+#scroll-fixed {
            display: block;
        }

        .hide_class {
            display: none
        }

        .remove-item-class {
            cursor: pointer;
        }

        .w-48 {
            width: 48%;
        }

        .view-table-th {
            text-align: center !important;
            color: #fff !important;
        }

        .plus-class {
            margin-right: 5px;
            font-size: 20px;
            vertical-align: middle;
            color: #0849A5;
        }
		 .delete-class {
            margin-right: 5px;
            font-size: 20px;
            vertical-align: middle;
            color: white;
        }

        .header-tr {
            background-color: #074FA4 !important;
            /* cursor: pointer !important; */
            transition: 1s;
        }

        td.editable {
            cursor: pointer;
        }

        .header-tr:hover {
            background-color: #087383 !important;
        }




































        /* 
			#DataTables_Table_1_wrapper #DataTables_Table_1_info , #DataTables_Table_1_wrapper .dataTables_empty
,#DataTables_Table_1_wrapper #DataTables_Table_1_paginate
,#DataTables_Table_1_wrapper #DataTables_Table_1_length
{
	display: none !important;
}
.sorting_disabled.dtfc-fixed-right
{
	right:0 !important;
} */

    </style>
    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{url('assets/media/logos/logo_va.png')}}" />
    @toastr_css
    @livewireStyles
    @yield('css')
    @stack('css')
    <style>
        #loader_id {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .text-center {
            text-align: center
        }

        .please_wait {
            text-transform: capitalize;
            font-size: 1.2rem;
            font-weight: bold;
            color: #085E99;
        }

    </style>

    <script>
        function getToken() {
            return document.getElementsByTagName('body')[0].getAttribute('data-token');
        }

    </script>
</head>

<!-- end::Head -->
<!-- begin::Body -->
<body data-base-url="{{\Illuminate\Support\Facades\URL::to('/')}}" data-current-company-id="{{ $company->id ?? 0  }}" data-token="{{ csrf_token() }}" data-lang="{{ App()->getLocale() }}" style="background-image: url({{url('assets/media/demos/demo4/header.jpg')}}); background-position: center top; background-size: 100% 350px;height:100% !important" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    <input type="hidden" id="first-loading">
    <div class="text-center hide_class" id="loader_id">
        <img src="{{ asset('loading.gif') }}">
        <p class="please_wait">Please Wait</p>
    </div>
    <!-- begin::Page loader -->

    <!-- end::Page Loader -->

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="#">
                <img height="65px" alt="Logo" src="{{url('assets/media/logos/logo_va.png')}}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            {{-- SideBAr --}}
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                @auth
                @include('layouts.topbar')

                @endauth
				
	{{-- {{ dd($studyStartDate) }} --}}
				
				
                <!-- begin:: Header -->
                <!-- end:: Header -->
                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                    <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title" style="font-variant: small-caps;">
                                        @yield('sub-header')
                                    </h3>
                                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
                                            @yield('dash_nav')
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- end:: Subheader -->

                        <!-- begin:: Content -->
                        <div class="kt-container  kt-grid__item kt-grid__item--fluid">

                            <!--Begin::Dashboard 4-->

                            @yield('content')


                            <div id="popup-form-container-id" class="popup-form-container">
                                <x-form.bs-modal :submitBtnClass="'submit-popup-btn-class'" :id="'add-dynamic-form-id'" :model-body-id="'append-dynamic-form-body-id'" :modal-title-id="'append-dynamic-form-title-id'">

                                </x-form.bs-modal>
                            </div>

                            {{--
										<div id="scroll-fixed" class=""
								style="position: fixed;
									top: 50%;
									right: 100px;
									z-index:999999999999999;
									font-size:2.5rem;">

							<a id="to__left" href="#" class="to-left">
								<i class="fas fa-arrow-circle-left "></i>
							</a>


							<a id="to__right" href="#" class="to-right">
								<i class="fas fa-arrow-circle-right"></i>
							</a>
							
							</div> --}}


                            <!--End::Row-->

                            <!--End::Dashboard 4-->
                        </div>

                        <!-- end:: Content -->
                    </div>
                </div>

                <!-- begin:: Footer -->
                @include('layouts.footer')

                <!-- end:: Footer -->
            </div>



            {{-- @include('layouts.sidebar') --}}



        </div>
    </div>

    <!-- end:: Page -->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#366cf3"
                    , "light": "#ffffff"
                    , "dark": "#282a3c"
                    , "primary": "#5867dd"
                    , "success": "#34bfa3"
                    , "info": "#36a3f7"
                    , "warning": "#ffb822"
                    , "danger": "#fd3995"
                }
                , "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"]
                    , "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };

    </script>

    <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
    <script src="{{url('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap/dist/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>

    <script>
        function updateField(route, parent = null) {
            $.ajax({
                type: 'GET'
                , url: route
                , data: {
                    "_token": "{{csrf_token()}}"
                , }
                , cache: false
                , contentType: false
                , processData: false
                , success: (res) => {
                    if (res.status) {

                        if (parent && parent.length) {
                            parent.find('#' + res.append_id).empty().append(res.result).trigger('change').trigger('changed.bs.select').selectpicker('render').selectpicker('setStyle', 'btn-large', 'remove');
                        } else {
                            if (res.isFullQuerySelector) {
								
                                // alert()
                                if (res.addNew != '0') {
									
                                    $(res.append_id).find('option:not(.add-new-item)').remove();
                                    $(res.append_id).find('option.add-new-item').after(res.result).selectpicker('refresh').trigger('change')
                                } else {
                                    $(res.append_id).empty().append(res.result).selectpicker('refresh').trigger('change');

                                }
                            } else {
								
                                $('#' + res.append_id).empty().append(res.result).trigger('changed.bs.select').trigger('changed.bs.select').selectpicker('render');
                                $('#' + res.append_id).selectpicker('refresh').trigger('change');
								reinitializeSelect2()
                            }
                            // alert(res.append_id);
                        }
                        // reinitializeSelect2();

                    }
                }
                , error: function(data) {}
            });


        }

    </script>

    <script>
        // Varying Target/pricing


        let oldValForInputNumber = 0;
        $('input:not([placeholder]):not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([readonly]):not(.exclude-text):not(.date-input)').on('focus', function() {
            oldValForInputNumber = $(this).val();
            $(this).val('')
        })
        $('input:not([placeholder]):not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([readonly]):not(.exclude-text):not(.date-input)').on('blur', function() {

            if ($(this).val() == '') {
                $(this).val(oldValForInputNumber)
            }
        })

        $(document).on('change', 'input:not([placeholder])[type="number"],input:not([placeholder])[type="password"],input:not([placeholder])[type="text"],input:not([placeholder])[type="email"]', function() {
            let val = $(this).val()
            val = number_unformat(val)
            $(this).parent().find('input[type="hidden"]').val(val)
        })
        $(document).on("click", ".target_last_value,.pricing_last_value", function() {
            let parent = $(this).closest('table');
            //const year = $(this).data('year')
			
            const index = $(this).attr('data-index');
            const repeatingDirection = hasAttribute($(this).attr('data-repeating-direction')) ? $(this).attr('data-repeating-direction') : 'row';

            const order = +$(this).attr('data-order')
			console.log(index,repeatingDirection,order)
            var chosen_val = parent.find('.target_repeating_amounts[data-order="' + order + '"][data-index="' + index + '"]').val();
            chosen_val = chosen_val ? chosen_val : 0;
            targets = {};


            // totals-percentage-of-column
            if (repeatingDirection == 'row') {
                parent.find('.target_last_value').each(function(key, val) {
                    var loopIndex = $(val).attr('data-index')
                    var loopOrder = $(val).attr('data-order')
                    if (loopOrder >= order && index == loopIndex) {

                        var loopYear = parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').attr('data-year')
                        var oldVal = parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').val()
                        parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').val(chosen_val).trigger('keyup');
                        parent.find('.target_repeating_values[data-order="' + loopOrder + '"][data-index="' + loopOrder + '"]').attr('value', chosen_val);
                        this.style.width = ((chosen_val.length + 1) * 10) + 'px';
                        var total = 0;
                        total = totalforEachColumn(parent, loopYear);

               
                    }


                });
            } else {
                parent.find('.target_last_value').each(function(key, val) {
                    var loopIndex = $(val).attr('data-index')
                    var loopOrder = $(val).attr('data-order')
                    if (loopOrder == order && index <= loopIndex) {
                        var loopYear = parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').attr('data-year')
                        var oldVal = parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').val()
                        parent.find('.target_repeating_amounts[data-order="' + loopOrder + '"][data-index="' + loopIndex + '"]').val(chosen_val).trigger('keyup');
                        parent.find('.target_repeating_values[data-order="' + loopOrder + '"][data-index="' + loopOrder + '"]').attr('value', chosen_val).trigger('change');
                        this.style.width = ((chosen_val.length + 1) * 10) + 'px';
                        var total = 0;
                        total = totalforEachColumn(parent, loopYear);
                    }


                });

            }




        });


        $(document).on('keyup blur', '.target_repeating_amounts', function() {

            let val = $(this).val()
            val = number_unformat(val)
            if (val != '') {
                $(this).parent().find('input[type="hidden"]').val(val)
            }

            let parent = $(this).closest('table')
            let tr = $(this).closest('tr')
            let year = $(this).attr('data-year')

            let currentVal = number_unformat($(this).val())

            let lastOldVal = $(this).val()
            let hasRowTotal = +$(this).attr('data-has-row-total')
            let maxRowTotal = +$(this).attr('data-max-row-total')

            let hasColumnTotal = +$(this).attr('data-has-column-total')
            let maxColumnTotal = +$(this).attr('data-max-column-total')
            let isPercentage = +$(this).attr('data-is-percentage')
            let noDigits = +$(this).attr('data-no-digits')
            let fixedNumber = +$(this).attr('data-fixed-number')

            noDigits = noDigits ? noDigits : 0;
            if (hasRowTotal) {
                let total = calculateTotalRowForDirection(tr, year, 'row');
                if (fixedNumber) {
                    total = fixedNumber;
                }
                totalRow = tr.find('.result-of-total-row');
                totalRow = totalRow.length ? totalRow : tr.find('td:last-of-type input')
                totalRow.val(number_format(total, noDigits))
                if (maxRowTotal != 0 && total > maxRowTotal) {
                    //totalRow.val(number_format(total - currentVal  , noDigits))
                    $(this).val(0).trigger('keyup')
                    var title = "{{ __('Oops...') }}";
                    var message = "{{ __('Total Can Not Be Greater Than') }}" + ' ' + maxRowTotal
                    Swal.fire({
                        icon: "warning"
                        , title: title
                        , text: message
                    })
                }

            }
            if (hasColumnTotal) {

                let total = calculateTotalRowForDirection(parent, year, 'column');
                if (maxColumnTotal != 0 && total > maxColumnTotal) {

                    //tr.find('.result-of-total-row').val(number_format(total - currentVal  , 0))
                    var title = "{{ __('Oops...') }}";
                    var message = "{{ __('Total Can Not Be Greater Than') }}" + ' ' + maxColumnTotal
                    Swal.fire({
                        icon: "warning"
                        , title: title
                        , text: message
                    })
                    $(this).val(0).trigger('keyup').trigger('change')
                    //parent.find('tr:last-of-type input[data-column-identifier="'+year+'"]').val(number_format(total - currentVal,noDigits))

                } else {
                    parent.find('tr:last-of-type input[data-column-identifier="' + year + '"]').val(number_format(total, noDigits))
                }

            }



        })
        $(function() {
            $('[data-has-column-total="1"],[data-has-row-total="1"]').trigger('keyup')
            $(function() {

                $('[data-fixed-number]').each(function(index, element) {
                    $(element).val($(element).attr('data-fixed-number'))
                })
            })
        })

        function calculateTotalRowForDirection(parent, year, direction) {
            let total = 0;
            if (direction == 'row') {
                // parent == tr
                parent.find('input[type="hidden"]').each(function(index, input) {
                    var inputValue = parseFloat($(input).val());
                    if (!isNaN(inputValue)) {
                        total += inputValue;
                    }
                })
            }
            if (direction == 'column') {

                // parent == table
                var columnInputsHidden = parent.find('input[type="hidden"][data-column-identifier="' + year + '"]');

                let hasColumnIdentifier = columnInputsHidden.length;
                if (!hasColumnIdentifier) {
                    alert('please Add Column Identifier [data-column-identifier] in input hidden ')
                    return
                }
                columnInputsHidden.each((index, inputHidden) => {
                    total += parseFloat($(inputHidden).val())
                })




            }
            return total;
        }

        function calculateTotalRowForColumn(parent, columnIdentifierValue, columnIdentifierName = 'data-year') {

            let elements = parent.find('.target_repeating_amounts[' + columnIdentifierName + '="' + columnIdentifierValue + '"]+input:hidden');
            elements.each(function(key, input) {
                totalOfCurrentYear += parseFloat($(input).val())
            })

        }



        //total Per year
        function totalforEachColumn(parent, year) {
            // let totalOfCurrentYear = 0;
            // let elements = parent.find('.target_repeating_amounts[data-year="' + year + '"]');
            // let mustBe100 = hasAttribute(elements.attr('data-total-must-be-100'));
            // let totalOfProducts = hasAttribute(elements.attr('data-total-of-products'))
            // let triggerChangeForTotalProducts = parent.hasClass('share-table')
            // elements.each(function(key, input) {
            //     totalOfCurrentYear += parseFloat($(input).val())
            // })

            //   if (totalOfProducts) {
            //       totalOfCurrentYear = 0;
            //       elements.each(function(key, input) {
            //           var currentIndex = $(this).attr('data-index')
            //           var originCellVal = $('table.discount-table').find('.target_repeating_amounts[data-year="' + year + '"][data-index="' + currentIndex + '"]').val();
            //           originCellVal = roundToTwoDecimals(originCellVal);
            //           var correspondingCellVal = roundToTwoDecimals($('.target_repeating_amounts[data-year="' + year + '"][data-index="' + currentIndex + '"]').val())
            //           totalOfCurrentYear += parseFloat(originCellVal / 100 * correspondingCellVal / 100)
            //       })
            //       totalOfCurrentYear = totalOfCurrentYear * 100
            //
            //   }
            //
            //     if (mustBe100 && totalOfCurrentYear > 100) {
            //         var title = "{{ __('Oops...') }}";
            //         var message = "{{ __('Total Can Not Be Greater Than 100') }}"
            //         Swal.fire({
            //             icon: "warning"
            //             , title: title
            //             , text: message
            //         })
            //         return false;
            //         //		return ;
            //
            //     }

            //  let width = ((totalOfCurrentYear.length + 1) * 10) + 'px';
            //
            //  parent.find('.totals-percentage-of-column[data-year="' + year + '"]').val(roundToTwoDecimals(totalOfCurrentYear)).css('width', width)
            //  if (triggerChangeForTotalProducts) {
            //      $('.discount-table tr:first-of-type td .target_repeating_amounts').trigger('keyup')
            //  }
            //  return true;
        }

        $(document).on('click', '.copy-btn', function(e) {
            e.preventDefault();
            const element = $(this).closest('form').find('.copyableField');
            $(element).select();
            document.execCommand("copy");
        });
        $(document).on('hidden.bs.modal', function() {
            $('.shareable-btn').removeClass('copy-btn');
            $('.shareable-btn').html("{{ __('Generate Link') }}")
        })

        function getExpandAndCollpaseIcon() {
            return '<img src="' + '../../../assets/media/icons/svg/Navigation/Angle-down.svg' + '"/>';
        }

    </script>

    <!--end:: Global Mandatory Vendors -->
    <!--begin:: Global Optional Vendors -->
    <script src="{{url('assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
    <script src="{{url('global.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('swal.js') }}"></script>

    <script>
        function get_total_of_object(object, date) {
            let total = 0;
            for (obj of object) {
                if (obj.pivot && obj.pivot.payload) {
                    var valueFormatted = JSON.parse(obj.pivot.payload)[date];
                    if (valueFormatted) {
                        valueFormatted = valueFormatted.replace(/,/g, "");
                        total = total + parseFloat(valueFormatted);
                    }


                }
            }

            return total;
        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number
                , prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
                , sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep
                , dec = (typeof dec_point === 'undefined') ? '.' : dec_point
                , s = ''
                , toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

    </script>
    <!--end:: Global Optional Vendors -->


    <!--end::Global Theme Bundle -->



    <!--end::Page Vendors -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{url('assets/js/demo4/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--begin::Page Scripts(used by this page) -->
	
    <script src="{{url('assets/js/demo4/pages/dashboard.js')}}" type="text/javascript"></script>
    {{-- @jquery --}}
    @toastr_js
    @toastr_render
    @yield('js')
    @if(isLoanRoute())
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
    </script>

    @else
    <script src="{{url('datatable/datatable.js')}}" type="text/javascript"></script>


    @endif
    @stack('js')

    <script>
        reinitializeSelect2();

    </script>
    <script>
        // $(function(){
        // 	$(document).on('change','select.select2-select', function (e) {
        // 		let maxOptionsNumber = $(this).data('max-options') ;
        // 		let currentSelectedOptionsNumber = $(this).find('option:selected').length;
        // 		let labelMaxSelection = currentSelectedOptionsNumber ;
        // 		if(maxOptionsNumber)
        // 		{

        // 			if(currentSelectedOptionsNumber > maxOptionsNumber )
        // 			{
        // 				labelMaxSelection = maxOptionsNumber ;

        // 				$(this).find('option:selected').each((index,value)=>{
        // 					if((index+1) > maxOptionsNumber )
        // 					{
        // 						$(value).prop('selected',false);
        // 					}
        // 				});
        // 				$(this).selectpicker("refresh");
        // 			}
        // 		}
        // 		$(this).closest('div[class*="col-md"]').find('.max-options-span').html('[Selected:' +labelMaxSelection + ']');

        // 		}	);
        // });

    </script>

    <script>
        $(document).ajaxStart(function() {
            // $('select.select2-select').prop('disabled',true);				
            $('#loader_id').removeClass('hide_class');
        });
        $(document).ajaxComplete(function() {
            // $('select.select2-select').prop('disabled',false);

            $('#loader_id').addClass('hide_class');
			if($('select.select2-select').selectpicker){
            $('select.select2-select').selectpicker('refresh');
				
			}

        })




        // 			function delay(fn, ms) {
        //   let timer = 0
        //   return function(...args) {
        //     clearTimeout(timer)
        //     timer = setTimeout(fn.bind(this, ...args), ms || 0)
        //   }
        // }

        function makeDelay(ms) {
            var timer = 0;
            return function(callback) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        };

    </script>

    <script>
        $(function() {
            $('.dtfc-fixed-left').on('click', function(e) {
                $('.kt_table_with_no_pagination').DataTable().columns.adjust();
            });


        })

    </script>
    <script>
        $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
            jqXHR.setRequestHeader('X-CSRF-Token', getToken());
        });

    </script>

    @if(session()->has('fail'))
    <script>
        toastr.error('{{ session()->get("fail") }}')

    </script>

    @endif

    <script>
        function exportToExcel(xlsx) {



            numberOfRows = 0;
            eachInRow = 0;

            let companyName = "{{ isset($company) && isset($company->name['en']) ? $company->name['en'] : '' }}";
            if (companyName) {
                eachInRow += 1;
            }
            let reportName = $('.kt-subheader__title').html().trim() || $('.kt-portlet__head-title').html().trim();

            if (reportName) {
                companyName += (' (' + reportName + ' )');
            }
            let start_date = "{{ isset($start_date) ? $start_date : '' }}";
            let end_date = "{{ isset($end_date) ? $end_date : '' }}";
            let date = "{{ isset($date) ? $date : '' }}";
            if ((start_date && end_date) || date) {
                eachInRow += 1;
            }

            var sheet = xlsx.xl.worksheets['sheet1.xml'];
            var downrows = eachInRow;
            var clRow = $('row', sheet);

            clRow.each(function() {
                var attr = $(this).attr('r');
                var ind = parseInt(attr);
                ind = ind + downrows;
                $(this).attr("r", ind);
            });


            $('row c ', sheet).each(function() {
                var attr = $(this).attr('r');
                var pre = attr.substring(0, 1);
                var ind = parseInt(attr.substring(1, attr.length));
                ind = ind + downrows;
                $(this).attr("r", pre + ind);
            });

            function Addrow(index, data) {
                msg = '<row  r="' + index + '">'
                for (i = 0; i < data.length; i++) {
                    var key = data[i].k;
                    var value = data[i].v;
                    msg += '<c   t="inlineStr" r="' + key + index + '" s="2">';
                    msg += '<is>';
                    msg += '<t >' + value + '</t>';
                    msg += '</is>';
                    msg += '</c>';
                }
                msg += '</row>';
                return msg;
            }
            // let visiables = [];
            let headers = [];
            currentColumn = 'A'
            currentColumnHeaders = 'A'
            rows = ' ';


            // let calculatedLoanAmount = 'calculated here' ;
            // let reportNameWithValues  = calculatedLoanAmount ? [reportName.slice(0, -1), ' = ' + calculatedLoanAmount, reportName.slice(-1)].join('') : reportName;
            rows += Addrow(1, [{
                k: 'A'
                , v: companyName
            }]);

            if (start_date && end_date) {
                rows += Addrow(2, [{
                        k: 'A'
                        , v: 'Start Date : ' + start_date
                    }
                    , {
                        k: 'B'
                        , v: 'End Date : ' + start_date
                    }
                , ]);

            }
            if (date && !start_date) {
                rows += Addrow(2, [{
                    k: 'A'
                    , v: 'Date : ' + date
                }, ]);
            }



            sheet.childNodes[0].childNodes[1].innerHTML = rows + sheet.childNodes[0].childNodes[1].innerHTML;

        }

    </script>

    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number
                , prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
                , sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep
                , dec = (typeof dec_point === 'undefined') ? '.' : dec_point
                , s = ''
                , toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        const capitalizeEachWord = (phrase) => {
            return phrase
                .toLowerCase()
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        };

        function getVisiablFields() {
            let visiableFields = [];
            let EmptyFields = [];

            $('select , input').each(function(index, field) {

                if ($(field).closest('.item-main-parent').length && !$(field).closest('.item-main-parent').is(
                        ':hidden')) {
                    fieldName = ($(field).attr('name'));
                    fieldValue = $(field).val();

                    visiableFields.push({
                        "name": fieldName
                        , "value": fieldValue
                        , "index": index
                    });
                    if (!fieldValue) {
                        EmptyFields.push({
                            "index": index
                            , "name": fieldName
                        });
                    }
                }

            })

            return {
                "visableFields": visiableFields
                , "emptyFields": EmptyFields
            };

        }

        function getMonthFromDate(date) {
            return date.split('-')[1];
        }


        function roundToTwoDecimals(num) {
            return Math.round(num * 100) / 100;
        }

        function hasAttribute(attr) {
            return typeof attr !== 'undefined' && attr !== false
        }
        Date.prototype.addMonths = function(value) {
            var n = this.getDate();
            this.setDate(1);
            this.setMonth(this.getMonth() + value);
            this.setDate(Math.min(n, this.getDaysInMonth()));
            return this;
        };
        Date.isLeapYear = function(year) {
            return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
        };

        Date.getDaysInMonth = function(year, month) {
            return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
        };

        Date.prototype.isLeapYear = function() {
            return Date.isLeapYear(this.getFullYear());
        };

        Date.prototype.getDaysInMonth = function() {
            return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
        };


        function closestNumber(n, m) {
            let q = parseInt(n / m);

            let n1 = m * q;
            let n2 = (n * m) > 0 ?
                (m * (q + 1)) : (m * (q - 1));

            if (Math.abs(n - n1) < Math.abs(n - n2))
                return n1;
            return n2;
        }

    </script>



    <script>
        $(function() {
            $(document).on('click', '.filter-btn-class', function(e) {
                e.preventDefault();
                let datatableInstance = $(this).data('datatable-id');
                $('#' + datatableInstance).DataTable().ajax.reload(null, false);
            });
            $(document).on('click', function(e) {
                // close opened custom modal [for filter and export btn]
                let target = e.target;
                if (!$(target).closest('.close-when-clickaway').length && !$(target).closest('.do-not-close-when-click-away').length) {
                    $('.close-when-clickaway').addClass('d-none');
                }
            });

            $(document).on('click', '.delete-record-btn', function(e) {
                e.preventDefault();
                let modelName = $(this).data('model-name');
                let recordId = $(this).data('record-id');
                let tableId = $(this).data('table-id')

                Swal.fire({
                    title: "{{ __('Are you sure?') }}"
                    , text: "{{ __('You will not be able to revert this!') }}"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#d33'
                    , cancelButtonColor: 'rgb(0, 36, 71)'
                    , confirmButtonText: '{{ __("Yes,Delete It") }}'
                    , preConfirm: function() {
                        return {
                            'modelName': modelName
                            , 'recordId': recordId
                            , 'tableId': tableId
                        };
                    }
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.model') }}"
                            , data: {
                                "recordId": result.value.recordId
                                , 'modelName': result.value.modelName
                                , 'tableId': result.value.tableId
                            }
                            , type: "delete"
                            , success: function(response) {
                                $('#' + response.tableId).DataTable().ajax.reload(null, false);
                            }
                        });
                    }
                })
            });

            $(document).on('click', '.submit-form-btn', function(e) {
                e.preventDefault();

                // Validate form before submit
                form = $(this).closest('form')[0]

                var formData = new FormData(form);

                this.disabled = true;
                $.ajax({
                    type: "POST"
                    , url: $(form).attr('action')
                    , data: formData
                    , cache: false
                    , contentType: false
                    , processData: false
                    , success: function(res) {

                        if (res.status) {
                            if (res.showAlert) {

                                Swal.fire({
                                    icon: 'success'
                                    , title: res.message
                                    , buttonsStyling: false
                                    , customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                    // text: successMessage,
                                }).then(function() {
                                    $('.submit-form-btn').disabled = false;
                                    Swal.fire({
                                        text: "Form has been successfully submitted!"
                                        , icon: "success"
                                        , buttonsStyling: false
                                        , confirmButtonText: "Ok, got it!"
                                        , customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            // Hide modal
                                            // modal.hide();

                                            // Enable submit button after loading
                                            $('.submit-form-btn').prop('disabled', false);

                                            // Redirect to customers list page
                                            // window.location.location = "";
                                        }
                                    })

                                })
                            } else {
                                $('.submit-form.btn').prop('disabled', false);
                                window.location.href = "{{ route('admin.view.revenue.business.line',getCurrentCompany() ? getCurrentCompany()->getIdentifier( ) : 0 ) }}"
                            }

                        } else {
                            $('#submit-form-btn').prop('disabled', false)

                            Swal.fire({
                                icon: 'error'
                                , title: res.message,

                            })
                        }
                    }
                    , error: function(res) {

                        $('.submit-form-btn').prop('disabled', false)

                        Swal.fire({
                            icon: 'error'
                            , title: res.responseJSON.message,

                        })


                    }
                })



            });

            $(document).on('change', '.trigger-select-class', handleAddNewField);
            $(document).on('click', '.trigger-select-class + button + .dropdown-menu div.inner', handleAddNewField);

            function handleAddNewField(e) {
                var id = $(this).data('trigger-id') || $(this).closest('.dropdown.trigger-select-class').find('.trigger-select-class').data('trigger-id');
                var optionValue = $(this).val() || $(this).closest('.dropdown.trigger-select-class').find('.trigger-select-class').val();
                if (id == 'child-trigger-1' && optionValue == 'Add New') {
                    $('.child-trigger').removeClass('d-none');
                    $('#' + id).removeClass('d-none');
                }
				else if (id == 'child-trigger-2' && optionValue == 'Add New') {
                    $('.child-trigger').removeClass('d-none');
                    $('.business_line_name').addClass('d-none');
                }
				else if (id == 'child-trigger-3' && optionValue == 'Add New') {
                    $('.child-trigger').removeClass('d-none');
                    $('.business_line_name').addClass('d-none');
                    $('.service_category_name').addClass('d-none');
                }
				 else {
                    $('.child-trigger').addClass('d-none');
                }
            }
			$('select.trigger-select-class.revenue_business_line_class').trigger('change');


        });

    </script>

    <script>
        $(function() {
            $('#first-loading').remove();
			$('select.main-service-item').trigger('change');
        })



        $(document).on('change', '.has-total-cell', function() {
            const index = $(this).attr('data-index')
            const order = +$(this).attr('data-order')
            const closestCommponParnetQuery = $(this).attr('data-closest-parent-query')
            const closestCommonParent = $(this).closest(closestCommponParnetQuery);
            const resultCell = closestCommonParent.find('.result-of-total-row')
            const numberFormatCell = resultCell.attr('data-number-format-digits')
            const isPercentageTotal = +resultCell.attr('data-is-percentage')
            const maxValueForTotal = +$(resultCell).attr('data-max-total-value');
            const totalType = $(resultCell).attr('data-total-type') // row or column 




            if (totalType == 'row') {

                let total = 0;

                closestCommonParent.find('.has-total-cell[data-index="' + index + '"]').each(function(index, input) {
                    total += parseFloat($(input).val());
                })


                if (maxValueForTotal && isPercentageTotal && total > maxValueForTotal) {
                    $(this).val(0);
                    Swal.fire({
                        icon: "warning"
                        , title: "{{ __('Oops!') }}"
                        , text: "{{ __('Total must be ') }}" + maxValueForTotal
                    })
                } else {
                    resultCell.val(number_format(total, numberFormatCell)).trigger('change')
                }

            }


        })

    </script>
    <script>
        $(function() {
			function initialMonthYearPicker(index, dateInput) {
                var currentDate = $(dateInput).val();
                var startDate = "{{ isset($studyStartDate) && $studyStartDate ? $studyStartDate : -1 }}";
                startDate = startDate == '-1' ? '' : startDate;
                var endDate = "{{ isset($studyEndDate) && $studyEndDate? $studyEndDate : -1 }}";
                endDate = endDate == '-1' ? '' : endDate;

                $(dateInput).datepicker({
                        viewMode: "year"
                        , minViewMode: "year"
                        , todayHighlight: false
                        , clearBtn: true,


                        autoclose: true
                        , format: "mm/01/yyyy"
                    , })
                    .datepicker('setDate', new Date(currentDate))
                    .datepicker('setStartDate', new Date(startDate))
                    .datepicker('setEndDate', new Date(endDate))
            }
			window['initialMonthYearPicker']=initialMonthYearPicker
			
            $('.only-month-year-picker').each(initialMonthYearPicker)


        });

        $(document).on('change', '.largest-width', function() {
            let order = $(this).attr('data-order');
            let maxWidth = 0;
            let targetItems = $(this).closest('table').find('input.largest-width[data-order="' + order + '"]');
            targetItems.each(function(index, input) {
                var width = $(input).css('width');
                width = parseFloat(width.slice(0, -2));
                if (width > maxWidth) {
                    maxWidth = width;
                }

            })
            targetItems.css('width', maxWidth + 'px');

        })

    </script>


@stack('js_end')

</body>

<!-- end::Body -->
</html>
