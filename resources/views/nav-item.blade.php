<style>
    .second-sub-text {
        color: #074FA4 !important;
        font-size: 14px !important;
        font-weight: 500 !important;
		white-space:nowrap !important;
    }
	.third-sub-text{
	    color: #074FA4 !important;
        font-size: 14px !important;
        font-weight: 400 !important;
	}

</style>
@if($navItem['show'])
<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="@if(isset($navItem['sub_items']) && count($navItem['sub_items']))  javascript:; @else {{ $navItem['link'] }} @endif" class="kt-menu__link  
@if(isset($navItem['sub_items']) && count($navItem['sub_items']))
kt-menu__toggle loool
@endif 

">
        <span class="kt-menu__link-text font-size-1-25rem first-sub-text"> {{ $navItem['name'] }} </span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    @if(isset($navItem['sub_items']) && count($navItem['sub_items']) )
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
        <ul class="kt-menu__subnav">
            @foreach ($navItem['sub_items'] as $subItemOptions)
            @php
            $link = $subItemOptions['link'];
            $subItemName = $subItemOptions['name'];
            $showSubItem = $subItemOptions['show'];
            @endphp

            @if(! (isset($subItemOptions['sub_items']) && count($subItemOptions['sub_items'])) && $showSubItem)
            <li class="kt-menu__item " aria-haspopup="true">
                <a href="{{ $link }}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-crosshairs font-size-15px"></i>
                    {{-- <i class="kt-menu__link-icon fa-fw flaticon-money"></i> --}}
                    {{-- <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i> --}}
                    <span class="kt-menu__link-text second-sub-text">{!! $subItemName !!}</span>

                </a>
            </li>
            @endif


            @if(isset($subItemOptions['sub_items']) && count($subItemOptions['sub_items']) && $showSubItem)
            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                <a href="#" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-crosshairs font-size-15px"></i>
                    {{-- <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i> --}}
                    <span class="kt-menu__link-text second-sub-text">{!! $subItemName !!}</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                        @foreach($subItemOptions['sub_items'] as $link=>$thirdSubOptions)
                        @if($thirdSubOptions['show'])

                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{ $thirdSubOptions['link'] }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon fa fa-crosshairs font-size-15px"></i>
                                <span class="kt-menu__link-text third-sub-text">{{ $thirdSubOptions['name'] }}</span>
                            </a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif
            @endforeach

        </ul>
    </div>
    @endif
</li>
@endif
