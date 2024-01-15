@extends('layouts.dashboard')
@section('css')
    <style>
        table {
            white-space: nowrap;
        }
        
    </style>

    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('sub-header')
    {{$section->name[lang()]}}
@endsection
@section('content')
<div class="col-md-12">

    <!--begin:: Widgets/Tasks -->
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <div class="kt-portlet__head">

            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                    <?php $section_key = 0;?>
                    @foreach ($section->subSections->sortBy('order') as   $subSection)
             
                        @if ($section != 'SalesBreakdownAnalysis')

                            <?php $name = $subSection->name['en'] ;
                            if ($subSection->name['en'] == "Products / Services") {
                                $name = "Product Or Service Name";
                            }   ?>
                        @endif
                       
                        @if (($section->name['en'] == 'Sales Breakdown Analysis Report' && $subSection->name['en'] !== "Customers Nature" && $subSection->name['en'] !== "Service Providers" && $subSection->name['en'] !== 'Sales Discounts') ||
                        ($subSection->name['en'] == "Customers Nature" && (false !== $found =  array_search('Customer Name',$viewing_names))) ||
                            ($subSection->name['en'] == "Service Providers" && ( @count(array_intersect(['Service Provider Type','Service Provider Name','Service Provider Birth Year'],$viewing_names)) > 0 ) ||
                            ($subSection->name['en'] == 'Sales Discounts' && (count(array_intersect(['Quantity Discount','Cash Discount','Special Discount'],$viewing_names)) > 0) )) || 
                            ($subSection->name['en'] == INVOICES && (count(array_intersect(['Document Type','Document Number'],$viewing_names)) > 0) )
                        ||(false !== $found = array_search(\Str::singular($name),       $viewing_names) || $subSection->name['en'] == "Average Prices" ))

                                <li class="nav-item">

                                    <a class="nav-link {{$section_key == 0 ? 'active' : ''}}" data-toggle="tab" href="#kt_widget2_tab1_content_{{$subSection->id}}" role="tab">
                                        <i
                                        class="kt-menu__ver-arrow {{ $subSection->icon }}"></i><span class="kt-menu__link-text">
                                            {{-- @dump($subSection->name[lang()]) --}}
                                            {{$subSection->name[lang()]}}
                                            </span>


                                    </a>
                                </li>
                            {{-- @endif --}}
                           <?php $section_key++; ?>
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <?php $section_key = 0;?>
                @foreach ($section->subSections as $key=> $mainSubSection)
             
                
                    @if ($section != 'SalesBreakdownAnalysis')


                        <?php $name = $mainSubSection->name['en'] ;

                        if ($mainSubSection->name['en'] == "Products / Services") {
                            $name = "Product Or Service Name";
                        }   ?>
                    @endif
                    @if ($section->name['en'] == 'Sales Breakdown Analysis Report' ||  (false !== $found =  array_search(\Str::singular($name),$viewing_names) || $mainSubSection->name['en'] == "Average Prices" )
                    || $mainSubSection->name['en'] == 'Invoices'
                    
                    )
                        

                     
                        <div class="tab-pane {{$section_key == 0 ? 'active' : ''}}" id="kt_widget2_tab1_content_{{$mainSubSection->id}}">
                            <div class="kt-widget2">
                                <div class="row">
                                    

                                    @foreach ($mainSubSection->subSections as $sub_section)

              
                                        @php $name_of_section = substr($sub_section->name['en'], strpos($sub_section->name['en'] , "Against")+8 ); @endphp 
                                                @if($name_of_section == 'Products')
                                                @php
                                                    $name_of_section ='Products / Services';
                                                @endphp
                                                @endif 

                                        @if ($section->name['en'] !== 'Sales Breakdown Analysis Report' && $mainSubSection->name['en'] !== "Average Prices" )
                                            @if ($name_of_section == "Products / Services")
                                                @php  $name_of_section = "Product Or Service Names" @endphp
                                            @elseif($name_of_section == "Products Items")
                                                @php  $name_of_section = "Product Items" @endphp
                                            @endif

                                            {{-- @if($sub_section->name['en'] == '') --}}
                                            @if ( ( false !== $found =  array_search(\Str::singular($name_of_section),$viewing_names)) || 
                                            


                                              str_contains($name_of_section,"es Analysis") 
                                            //   ||   
                                            //   str_contains($name_of_section,"s")  

                                             ||
                                            str_contains($name_of_section,"Sales Analysis")
                                            // ||str_contains($name_of_section,"Sales Breakdown") 
                                            ||(str_contains($name_of_section,"zones") && isset($exportables['zone']))
                                            ||(
                                                str_contains($name_of_section,"Customers")
                                             && (isset($exportables['customer_name']) || isset($exportables['customer_code']))
                                            )
                                            ||
                                             ($name_of_section == 'Sales Discounts' && (count(array_intersect(['Quantity Discount','Cash Discount','Special Discount','zones'],$viewing_names)) > 0) ) )
                           


                                                @if($name_of_section == 'customers')

                                                @endif 
                                                @if($sub_section->name['en'] == 'Products Against Zones')
                                                @endif 

                                                <div class="col-md-4">
                                                    <div class="kt-widget2__item kt-widget2__item--primary">
                                                        <div class="kt-widget2__checkbox">
                                                        </div>
                                                        @php 
                                                            $route = isset($sub_section->route) && $sub_section->route !== null ? explode('.', $sub_section->route) : null;
                                                        @endphp 
                                                        <div class="kt-widget2__info">
                                                            <a href="{{  route(@$sub_section->route, $company) }}" class="kt-widget2__title">
                                                                {{$sub_section->name[lang()]}}
                                                            </a>

                                                        </div>
                                                        <div class="kt-widget2__actions">

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @elseif ($mainSubSection->name['en'] == "Average Prices" )
                                            @php $name_of_section = substr($sub_section->name['en'], strpos($sub_section->name['en'] , "Average Prices Per ")+19  );

                                            @endphp 
                                            @if (false !== $found =  array_search(\Str::singular($name_of_section),$viewing_names) )
                                                <div class="col-md-4">
                                                    <div class="kt-widget2__item kt-widget2__item--primary">
                                                        <div class="kt-widget2__checkbox">
                                                        </div>
                                                        @php
                                                            $route = isset($sub_section->route) && $sub_section->route !== null ? explode('.', $sub_section->route) : null;
                                                        @endphp 
                                                        <div class="kt-widget2__info">
                                                            <a href="{{  route(@$sub_section->route, $company) }}" class="kt-widget2__title">
                                                                {{-- @dump($sub_section->name[lang()]) --}}
                                                                {{$sub_section->name[lang()]}}
                                                            </a>

                                                        </div>
                                                        <div class="kt-widget2__actions">

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @elseif ( $section->name['en'] == 'Sales Breakdown Analysis Report')



                                        {{-- @dump('qqq  ') --}}
                                                @if ($mainSubSection->name['en'] !== "Customers Nature" ||
                                                ($mainSubSection->name['en'] == "Customers Nature" && false !== $found =  array_search('Customer Name',$viewing_names)) ||
                                                ($mainSubSection->name['en'] == "Service Providers"  && (count(array_intersect(['Service Provider Type','Service Provider Name','Service Provider Birth Year'],$viewing_names)) >0))  )
                                                    @if ($mainSubSection->name['en'] == 'One Dimension')
                                                        @php $name_of_section = str_replace( " Sales Breakdown Analysis",'',  $sub_section->name['en']     );@endphp
                                                    @elseif ($mainSubSection->name['en'] == 'Sales Discounts')

                                                        @php $name_of_section = str_replace( " Versus Discounts",'',  $sub_section->name['en']     );@endphp
                                                    @elseif ($mainSubSection->name['en'] == 'Customers Nature')

                                                        @php $name_of_section = str_replace( " Versus Customers Natures Analysis",'',  $sub_section->name['en']     );@endphp
                                                    @elseif ($mainSubSection->name['en'] == 'Interval Comparing')
                                                        @php $name_of_section = str_replace( " Sales Interval Comparing Analysis",'',  $sub_section->name['en'] );@endphp

                                                        @if ($name_of_section == "Service Provider")
                                                            @php  $name_of_section = "Service Provider Name" @endphp
                                                        @elseif($name_of_section == "Service Provider Age Range")
                                                            @php  $name_of_section = "Service Provider Birth Year";  @endphp

                                                        @endif


                                                    @elseif ($mainSubSection->name['en'] == 'Two Dimension')
                                                        @php
                                                            $name_of_section = substr($sub_section->name['en'], strpos($sub_section->name['en'] , "Versus ")+7  );
                                                            
                                                            $name_of_second_section = substr($sub_section->name['en'], strpos($sub_section->name['en'] , " Versus ")   );
                                                            $name_of_first_section = str_replace( $name_of_second_section,'',  $sub_section->name['en']     );

                                                         if($name_of_section == "Products Items"){
                                                 $name_of_section = "Product Items" ;

                                                         }
                                            if($name_of_section === 'Products Items Ranking'){
                                                 $name_of_section = "Product Items"; 

                                            }

                                                  

                                                            if($name_of_section === 'Product Items Ranking'){

                                            }

                                            
                                                            
                                                        @endphp
 
                                                    @endif
                                                    @if ($name_of_section == "Products / Services" )
                                                        @php $name_of_section = "Product Or Service Names"; @endphp 
                                                    @endif
                                                    
                                                    @if (isset($name_of_first_section) && $name_of_first_section == "Products / Services" )
                                                        @php $name_of_first_section = "Product Or Service Names"; @endphp 
                                                    @endif

                                                    @if (isset($name_of_first_section) && $name_of_first_section == "Products / Services" )
                                                        @php $name_of_first_section = "Branch"; @endphp 
                                                    @endif

                                                    @if ($name_of_section == "Product Items Ranking" )
                                                        @php $name_of_section = "Product Items Ranking"; @endphp 
                                                    @endif

                                                    {{-- @dump($mainSubSection->name['en']) --}}
                                                    @if ((!isset($name_of_first_section) &&  false !== $found =  array_search(\Str::singular($name_of_section),$viewing_names)) ||
                                                        ( isset($name_of_first_section) && (false !== $found =  array_search(\Str::singular($name_of_section),$viewing_names)) && (false !== $found =  array_search(\Str::singular($name_of_first_section),$viewing_names)) ) || ($sub_section->name['en'] =="Discounts Breakdown Analysis") ||
                                                        ($sub_section->name['en'] == "Customers Natures Analysis") || (  ($sub_section->name['en'] == "Discounts Sales Interval Comparing Analysis") && (count(array_intersect(['Quantity Discount','Cash Discount','Special Discount'],$viewing_names)) > 0)) 
                                                        ||  $sub_section->name['en'] == 'Products Items Versus Branches' && isset($exportables['product_item']) && isset($exportables['branch'])
                                                        // ||  $sub_section->name['en'] == 'Business Sectors Versus Customers Natures Analysis'
                                                        || ($mainSubSection->name['en'] == "Service Providers") 
                                                        || ($name_of_section == "Product Items Ranking" && isset($exportables['product_item'] )  && /* not sure salah */  isset($exportables['branch'] ) ) 
                                                        || ($name_of_section == "Customers" &&  (isset($exportables['customer_name']) ))  

                                                   
                                                        )

                                                        <div class="col-md-4">
                                                            <div class="kt-widget2__item kt-widget2__item--primary">
                                                                <div class="kt-widget2__checkbox">
                                                                </div>
                                                                @php 
                                                                    $route = isset($sub_section->route) && $sub_section->route !== null ? explode('.', $sub_section->route) : null;
                                                                @endphp 


                                                                <div class="kt-widget2__info">
                                                                    <a href="{{  route(@$sub_section->route, $company) }}" class="kt-widget2__title">
                                                                      
                                                                        {{$sub_section->name[lang()]}}  
                                                                    </a>

                                                                </div>
                                                                <div class="kt-widget2__actions">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                @php  !isset($name_of_first_section) ?: $name_of_first_section = null   ; @endphp 
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <?php $section_key++; ?>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!--end:: Widgets/Tasks -->
</div>


@endsection

@section('js')
<script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>

@endsection
