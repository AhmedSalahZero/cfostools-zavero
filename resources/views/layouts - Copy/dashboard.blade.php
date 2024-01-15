<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
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

		<!--begin::Fonts -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="{{url('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />


		<!--end::Page Vendors Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="{{url('assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		 <link href="{{url('assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles(used by all pages) -->
        <link rel="stylesheet" href="{{url('assets/css/demo3/main.css')}}">
		<link href="{{url('assets/css/demo3/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles -->
        {{--
		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{url('assets/css/demo1/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/css/demo1/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/css/demo1/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('assets/css/demo1/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" /> --}}

		<!--end::Layout Skins -->
        <link rel="icon" type="image/png" href="{{asset('back_login/images/icons/favicon.ico')}}"/>
        @toastr_css
        @livewireStyles
        @yield('css')
	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo3panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				{{-- <a href="demo3/index.html">
					<img alt="Logo" src="{{url('assets/media/logos/logo_red.jpeg')}}" />
				</a> --}}
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
                @include('layouts.sidebar')
                <!-- end:: Aside -->

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					@include('layouts.topbar')
					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

							<!--Begin::Dashboard 1-->

							@yield('content')

							<!--End::Dashboard 1-->
						</div>

						<!-- end:: Content -->
					</div>

					@include('layouts.footer')
				</div>
			</div>
		</div>

		<!-- end:: Page -->


        <!-- Scripts -->
        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "dark": "#282a3c",
                        "light": "#ffffff",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>
        <!-- end::Global Config -->

		<!--begin:: Global Mandatory Vendors -->
		<script src="{{url('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
		<!--end:: Global Mandatory Vendors -->

        <!--begin:: Global Optional Vendors -->
        <script src="{{url('assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/vendors/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{url('assets/js/demo3/scripts.bundle.js')}}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->





        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="{{url('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/js/demo3/pages/dashboard.js')}}" type="text/javascript"></script>
        {{-- @jquery --}}
        @toastr_js
        @toastr_render
        @yield('js')
        <!--end::Page Scripts -->
        @livewireScripts
	</body>

	<!-- end::Body -->
</html>
