<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="demo3/index.html">
                <img alt="Logo" class="logo-custom" src="{{url('assets/media/logos/logo_red.jpeg')}}" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
            <ul class="kt-menu__nav text-center">

                <?php $client_sections = App\Models\Section::mainClientSideSections()->get(); ?>

                @foreach ($client_sections as $section)

                    @if ($section->route != null)
                    <?php

                        $route = isset($section->route) && $section->route !== null?  explode('.',$section->route) : null;
                    ?>
                        <li class="kt-menu__item {{Request::routeIs(@$route[0].'.*') ||  Request::routeIs(@$route[0]) ? 'kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{@$section->route == 'home' ? route(@$section->route) : route(@$section->route,$company)}}"
                            class="kt-menu__link "><i class="kt-menu__link-icon {{$section->icon}}"></i><span class="kt-menu__link-text">{{__($section->name[$lang])}}</span></a></li>
                    @else
                    {{-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers-1"></i><span class="kt-menu__link-text">{{__($section->name[$lang])}}</span></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Add New</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Edit</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Delete</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Import</span></a></li>
                            </ul>
                        </div>
                    </li> --}}
                    @endif
                @endforeach
                {{--  kt-menu__item--active --}}
                {{-- <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="{{route('home')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">{{__('Dashboard')}}</span></a></li> --}}
                {{-- <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers-1"></i><span class="kt-menu__link-text">Actions</span></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Add New</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Edit</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Delete</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Import</span></a></li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
