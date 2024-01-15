<ul class="kt-menu__nav ">
        <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{ route('dashboard', $company) }}"
                class="kt-menu__link 
                @if($active == 'sales_dashboard')
                active-button
                @endif 
                
                "><span class="kt-menu__link-text 
                     @if($active == 'sales_dashboard')
                active-text
                    @endif 
                
                ">{{ __('Sales Dashboard') }}</span></a>
        </li>
        <li class="kt-menu__item  kt-menu__item 
        
        @if($active == 'breadkdown_dashboard')
                active-button
                @endif 

        " aria-haspopup="true"><a href="{{ route('dashboard.breakdown', $company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text
                
                @if($active == 'breadkdown_dashboard')
                active-text
                    @endif 

                ">Breakdown Dashboard</span></a>
        </li>
        @if(canViewCustomersDashboard($exportables))
        <li class="kt-menu__item  kt-menu__item 
        @if($active == 'customer_dashboard')
                active-button
                @endif 
        
        " aria-haspopup="true"><a href="{{ route('dashboard.customers', $company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">{{__("Customers Dashboard")}}</span></a>
        </li>
        @endif
         @if(in_array('Sales Person',$exportables))
        <li class="kt-menu__item  kt-menu__item 
        
           @if($active == 'sales_person_dashboard')
                active-button
                @endif 

        " aria-haspopup="true"><a href="{{ route('dashboard.salesPerson', $company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text
                  @if($active == 'sales_person_dashboard')
                  active-text
                    @endif 


                ">{{__("Sales Person Dashboard")}}</span></a>
        </li>
        @endif
        @if(in_array('Cash Discount' , $exportables) || in_array('Special Discount' , $exportables) || in_array('Quantity Discount' , $exportables) || in_array('Other Discounts' , $exportables)  )
        <li class="kt-menu__item  kt-menu__item 
        
         @if($active == 'discount_dashboard')
                   active-button
                    @endif 

        " aria-haspopup="true"><a href="{{ route('dashboard.salesDiscount', $company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text 
                
                 @if($active == 'discount_dashboard')
                   active-text
                    @endif 

                ">{{__("Sales Discount Dashboard")}}</span></a>
        </li>
        @endif 
        <li class="kt-menu__item  kt-menu__item 
          @if($active == 'interval_dashboard')
                   active-button
                    @endif 

        
        " aria-haspopup="true"><a href="{{ route('dashboard.intervalComparing', $company) }}"
                class="kt-menu__link 
                
                
                "><span class="kt-menu__link-text 
                
                
                  @if($active == 'interval_dashboard')
                   active-text
                    @endif 
                    ">{{__("Interval Comparing Dashboard")}}</span></a>
        </li>

    </ul>