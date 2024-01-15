<!-- begin:: Header -->
<div id="kt_header" class="kt-header  kt-header--fixed fh-fixedHeader" data-ktheader-minimize="on">

    <div class="kt-container ">

        <!-- begin:: Brand -->
        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
            <a class="kt-header__brand-logo" style="display: inline-block;
				font-size: 25px;
				font-weight: bold;
				color: white;
				white-space: nowrap;
				" href="#">
             {{ env('APP_NAME') }}
          
            </a>
        </div>

        <!-- end:: Brand -->
        @if (!request()->route()->named('viewHomePage'))


            <!-- begin: Header Menu -->
            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                    class="la la-close"></i></button>
            <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                    <ul class="kt-menu__nav ">
                        @foreach ($client_sections ?? [] as $section)
                        {{-- mr mahmoud temporary condition --}}
                        @if(! ($section->id == 220) 
                        
                        ||
                          (Auth()->check() && ! in_array(Auth()->user()->id , preventUserFromForeCast() )) 
                          
                          )






                            @if ($section->route != null && count($section->subSections) == 0)
                                <?php $route = isset($section->route) && $section->route !== null ? explode('.', $section->route) : null; ?>

                                <li
                                    class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel
                                {{ Request::routeIs(@$route[0] . '.*') || Request::routeIs(@$route[0])? 'kt-menu__item--open kt-menu__item--here ': '' }} ">
                                    {{-- class="kt-menu__item    kt-menu__item--rel kt-menu__item--open kt-menu__item--here"  > --}}
                                    <a href="{{ @$section->route == 'home' ? route(@$section->route) : route(@$section->route, $company) }}"
                                        class="kt-menu__link  text-center">
                                        <span class="kt-menu__link-text ">{{ __($section->name[$lang]) }}</span><i
                                            class="kt-menu__ver-arrow {{ $section->icon }}"></i></a>
                                </li>
                            @elseif (count($section->subSections) > 0)

                                @if ($section->name['en'] == 'Trend Analysis Reports')
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;"
                                            class="kt-menu__link kt-menu__toggle"><span
                                                class="kt-menu__link-text">{{ $section->name[$lang] }}</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--left"
                                            style="width:1000px">
                                            <div class="kt-menu__subnav">
                                                <ul class="kt-menu__content">
                                                    {{-- ZONES --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Zones Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'zone.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    {{-- Sales Channels --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Sales Channels Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'salesChannels.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    {{-- Categories --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Categories Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'categories.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @elseif ($section->name['en'] == 'Breakdown Analysis Report')
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;"
                                            class="kt-menu__link kt-menu__toggle"><span
                                                class="kt-menu__link-text">{{ $section->name[$lang] }}</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--left"
                                            style="width:1000px">
                                            <div class="kt-menu__subnav">
                                                <ul class="kt-menu__content">
                                                    {{-- ZONES --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Zones Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'salesBreakdown.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    {{-- Sales Channels --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Sales Channels Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'salesChannels.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    {{-- Categories --}}
                                                    <li class="kt-menu__item ">
                                                        <h3 class="kt-menu__heading kt-menu__toggle"><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">{{ __('Categories Analysis Reports') }}</span><i
                                                                class="kt-menu__ver-arrow la la-angle-right"></i></h3>
                                                        <ul class="kt-menu__inner">

                                                            @foreach ($section->subSections()->where('route', 'like', 'categories.' . '%')->get() as $subSection)
                                                                <?php
                                                                $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                                ?>
                                                                <li class="kt-menu__item " aria-haspopup="true"><a
                                                                        href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-icon {{ $subSection->icon }}"></i><span
                                                                            class="kt-menu__link-text wording-nowrap">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    @if($section->name['en'] ==='Dashboard')


                                      <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                        {{-- {{Request::routeIs(@$route[0].'.*') ||  Request::routeIs(@$route[0]) ?  'kt-menu__item--open kt-menu__item--here ' : ''}}" --}} data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a
                                            href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                class="kt-menu__link-text">{{ $section->name[$lang] }}</span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>

 
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">

                                            <ul class="kt-menu__subnav">
                                                @foreach ($section->subSections as $subSection)
                                           
                                                
                                                @if(($subSection->name['en'] == 'Sales Person Dashboard' && in_array('Sales Person',$exportables)) )
                                                 @include('print_sections')                                                
                                              @continue
                                             
                                                @endif 
                                                @if( ($subSection->name['en'] == 'Customers Dashboard' &&  in_array('Customer Name',$exportables) ))
                                                     @include('print_sections')
                                                @continue
                                          
                                                @endif
                                                @if($subSection->name['en'] != 'Customers Dashboard' && $subSection->name['en'] != 'Sales Person Dashboard' )

                                                    
                                            
                                                  @include('print_sections')
                                                  @endif 
                                                @endforeach

                                            </ul>
                                        </div>
                                    </li>
                                    @else 
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                        {{-- {{Request::routeIs(@$route[0].'.*') ||  Request::routeIs(@$route[0]) ?  'kt-menu__item--open kt-menu__item--here ' : ''}}" --}} data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a
                                            href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                class="kt-menu__link-text">{{ $section->name[$lang] }} </span><i
                                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                @foreach ($section->subSections as $subSection)

                                                    {{-- Route with No Children --}}
                                                    @if ($subSection->route != null && count($subSection->subSections) == 0)
                                                    <?php
                                                    $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                    ?>
                                                        @if ($subSection->id == 222 || $subSection->id == 223 || $subSection->id == 224 || $subSection->id == 225 || $subSection->id == 226)
                                                            <?php
                                                                $show_route = 0 ;
                                                                $modified_seasonality =  App\Models\ModifiedSeasonality::where('company_id', $company->id)->first();
                                                                if (($subSection->id == 222 || $subSection->id == 226) && isset($modified_seasonality)  ) {
                                                                    $show_route = 1 ;
                                                                }
                                                                elseif ($subSection->id == 223 && isset($modified_seasonality) &&
                                                                (( App\Models\ExistingProductAllocationBase::where('company_id', $company->id)->first()) !== null) ) {
                                                                    $show_route = 1 ;
                                                                }elseif (($subSection->id == 224) && isset($modified_seasonality) &&
                                                                ((App\Models\SecondExistingProductAllocationBase::where('company_id', $company->id)->first()) !== null) ) {
                                                                    $show_route = 1 ;
                                                                }elseif (($subSection->id == 225  ) && isset($modified_seasonality) &&
                                                                ((App\Models\CollectionSetting::where('company_id', $company->id)->first()) !== null) ) {
                                                                    $show_route = 1 ;
                                                                }else {
                                                                    $show_route = 0;
                                                                }
                                                            ?>


                                                            @if ($show_route == 1)
                                                                <li class="kt-menu__item " aria-haspopup="true">
                                                                    <a href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                        class="kt-menu__link "><i
                                                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                            class="kt-menu__link-text">{{ __($subSection->name[$lang]) }}</span></a>
                                                                </li>
                                                            @endif
                                                        @else


                                                            <li class="kt-menu__item " aria-haspopup="true">
                                                                <a href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">{{ __($subSection->name[$lang]) }}</span></a>
                                                            </li>

                                                        @endif
                                                    @else
                                                        <?php
                                                        $route = isset($subSection->route) && $subSection->route !== null ? explode('.', $subSection->route) : null;
                                                        ?>

                                                        <li class="kt-menu__item " aria-haspopup="true">
                                                            <a href="{{ @$subSection->route == 'home' ? route(@$subSection->route) : route(@$subSection->route, ['company'=>$company->getIdentifier()]) }}"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">{{ __($subSection->name[$lang]) }}</span></a>
                                                        </li>
                                                       
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </li>

                                    @endif 
                                @endif
                            @endif
















                            @endif 
                        @endforeach




                    </ul>
					
					 
					
                </div>
            </div>
        @endif
        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar kt-grid__item">



            @role('super-admin')
                <!--begin: Quick Actions -->
                <div class="kt-header__topbar-item dropdown">
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px"
                        aria-expanded="true">
                        <span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right menu-height dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl"
                        style="
                                                    height:400px;
                                                    overflow-y: scroll;">
                        <form>

                            <!--begin: Head -->
                            <div class="kt-head kt-head--skin-dark"
                                style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
                                <h3 class="kt-head__title">
                                    Super Admin Features
                                    <span class="kt-space-15"></span>
                                </h3>
                            </div>

                            <!--end: Head -->







                            <div class="kt-grid-nav kt-grid-nav--skin-light">
                                <?php $counter = 0; ?>
                                @foreach ($super_admin_sections as $section)
                                    <?php $counter++; ?>
                                    @if ($counter == 1)
                                        <div class="kt-grid-nav__row">
                                    @endif
                                    <a href="{{ $section->route == 'roles.permissions.index' ? route($section->route, 'admin') : route($section->route) }}"
                                        class="kt-grid-nav__item">
                                        <span class="kt-grid-nav__icon">
                                            @if ($section->name[$lang] == 'Admin Users')
                                                <svg aria-hidden="true" style="height: 32;" focusable="false"
                                                    data-prefix="fas" data-icon="users-crown" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                    class="svg-inline--fa fa-users-crown fa-w-20 fa-9x">
                                                    <path fill="currentColor"
                                                        d="M96 224c35.35 0 64-28.65 64-64s-28.65-64-64-64-64 28.65-64 64 28.65 64 64 64zm224 32c53.02 0 96-42.98 96-96v-16H224v16c0 53.02 42.98 96 96 96zm256 0h-64c-17.59 0-33.5 7.11-45.07 18.59 40.27 22.06 68.86 62.03 75.13 109.41H608c17.67 0 32-14.33 32-32v-32c0-35.35-28.65-64-64-64zm-402.93 18.59C161.5 263.11 145.59 256 128 256H64c-35.35 0-64 28.65-64 64v32c0 17.67 14.33 32 32 32h65.94c6.27-47.38 34.85-87.34 75.13-109.41zM544 224c35.35 0 64-28.65 64-64s-28.65-64-64-64-64 28.65-64 64 28.65 64 64 64zm-147.2 64h-8.31c-20.84 9.96-43.89 16-68.49 16s-47.64-6.04-68.49-16h-8.31C179.58 288 128 339.58 128 403.2V432c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48v-28.8c0-63.62-51.58-115.2-115.2-115.2zM416 32l-48 24-48-24-48 24-48-24v80h192V32z"
                                                        class=""></path>
                                                </svg>
                                            @else
                                                <i class="{{ $section->icon }}"></i>
                                        </span>
                                @endif
                                <span class="kt-grid-nav__title">{{ __($section->name[$lang]) }}</span>
                                <span class="kt-grid-nav__desc">{{ __('Admin Side') }}</span>
                                </a>
                                @if ($counter == 2)
                            </div> <?php $counter = 0; ?>
                            @endif
                            @endforeach
                            @if ($counter == 1)
                    </div>
                    @endif


                </div>
                <!--end: Grid Nav -->
                </form>
            </div>
        </div>
    @endrole
    <!--end: Quick actions -->


    <!--begin: Language bar -->
    
    <!--end: Language bar -->

    <!--begin: User bar -->
    <?php $user = Auth::user();
    $first_letter = substr($user->name, 0, 1); ?>
    <div class="kt-header__topbar-item kt-header__topbar-item--user ">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown">
            @if (isset($company) && !request()->route()->named('home'))
                <div class="d-flex flex-column">
                    <div class="d-flex">
            @endif
            <span class="kt-header__topbar-welcome">Hi,</span>
            <span class="kt-header__topbar-username ">{{ $user->name }} </span>
            <span class="kt-header__topbar-icon"><b>{{ $first_letter }}</b></span> &nbsp;
            <?php
            $now = strtotime(date('Y-m-d')); // or your date as well
            $your_date = strtotime($user->expiration_date);
            $datediff = $your_date - $now;
            $days = round($datediff / (60 * 60 * 24));
            ?>
            @if ($user->subscription == 'free_trial')
                <span class="kt-header__topbar-username "><b>{{ $days . __(' Days Left') }}</b></span>
            @endif
            @if (isset($company) && !request()->route()->named('home'))
        </div>
        <h6><span class="kt-header__topbar text-center p-2"
                style="color: white;white-space: nowrap;">{{ $company->name[lang()] . ' ' . __('Company') }}</span>
        </h6>
    </div>
    @endif
    {{-- <img alt="Pic" src="{{  }}" class="kt-hidden" /> --}}

</div>
<br>

<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right menu-height dropdown-menu-anim dropdown-menu-xl">

    <!--begin: Head -->
    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
        style="background-image: url(./assets/media/misc/bg-1.jpg)">
        <div class="kt-user-card__avatar">
            {{-- <img class="kt-hidden"  alt="Pic" src="#" /> --}}

            <span
                class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ $first_letter }}</span>
        </div>
        <div class="kt-user-card__name text-dark">
            {{ $user->name }}
        </div>

    </div>

    <!--end: Head -->

    <!--begin: Navigation -->
    <div class="kt-notification">
        <div class="kt-notification__custom kt-space-between">
            <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">{{ __('Sign Out') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

















            {{-- <a href="demo3/custom/user/login-v2.html" target="_blank"
                                class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> --}}
        </div>
    </div>

    <!--end: Navigation -->
</div>
</div>

<!--end: User bar -->
</div>

<!-- end:: Header Topbar -->
</div>
</div>
