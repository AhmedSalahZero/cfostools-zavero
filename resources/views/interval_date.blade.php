                          
  @if(isset((get_defined_vars()['start_date_'.$k])) && (get_defined_vars()['start_date_'.$k]))

   <h3 class="kt-portlet__head-title container pt-3 text-center">

                            <b> {{__('From : ')}} </b>  {{ (\Carbon\Carbon::make(get_defined_vars()['start_date_'.$k])->format('d-m-Y')) }}

                            <b> - </b>
                            <b> {{__('To : ') }}</b> 
                            {{ (\Carbon\Carbon::make(get_defined_vars()['end_date_'.$k])->format('d-m-Y')) }}
                            
                             {{-- {{ get_defined_vars()['end_date_'.$i] }} --}}
                            <br>
                        </h3>
                        

  @endif 
  

