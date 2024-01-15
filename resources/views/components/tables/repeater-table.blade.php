@props([
	'repeater-with-select2'=>true,
'isRepeater'=>$isRepeater,
'relationName'=>$relationName,
'repeaterId'=>$repeaterId,
'tableName'=>$tableName ?? '',
'parentClass'=>$parentClass ?? ''
])
<div class="col-md-12 {{ $parentClass }}  js-parent-to-table" style="display:none">
    <hr style="width:100%;">
    <table id="{{ $repeaterId }}" class="table {{ $repeaterId }} table-white repeater-class repeater {{ $tableName }}"  >
        <thead>
            <tr>
                <x-tables.repeater-table-th class="col-md-1" :title="__('Action')"></x-tables.repeater-table-th>
                {{ $ths }}

            </tr>
        </thead>
        <tbody data-repeater-list="{{$tableName}}"
	
		>

            @if(isset($model) && $model->{$relationName}->count() )

            @foreach($model->{$relationName} as $subModel)
            <x-tables.repeater-table-tr :isRepeater="true" :model="$subModel"></x-tables.repeater-table-tr>

            @endforeach
            @else
            <x-tables.repeater-table-tr :trs="$trs" :isRepeater="true">

            </x-tables.repeater-table-tr>


            @endif

        </tbody>

        <td>
			{{-- @if(!$isRepeater) --}}
            <div  data-repeater-create="" class="btn btn btn-sm text-white   border-green bg-green  m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                <span>
                    <i class="fa fa-plus"> </i>
                    <span>
                        {{ __('Add') }}
                    </span>
                </span>
            </div>
			{{-- @endif --}}
        </td>

    </table>
</div>
@push('js_end')
	<script>
	$('#'+"{{ $repeaterId }}").repeater({            
            initEmpty: false,
              isFirstItemUndeletable: true,
            defaultValues: {
                'text-input': 'foo'
            },
             
            show: function() {
                $(this).slideDown();      
				$('input.trigger-change-repeater').trigger('change')   
				 $(this).find('.only-month-year-picker').each(function(index,dateInput){
					reinitalizeMonthYearInput(dateInput)
					
				 });
				$('input:not([type="hidden"])').trigger('change');
				$(this).find('.dropdown-toggle').remove();
				$(this).find('select.repeater-select').selectpicker("refresh");
					
            },

            hide: function(deleteElement) {
                if($('#first-loading').length){
                        $(this).slideUp(deleteElement,function(){
                   
                               deleteElement();
                            //   $('select.main-service-item').trigger('change');
                    });
                }
                else{
                     if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement,function(){
                   
                               deleteElement();
                              $('select.main-service-item').trigger('change');
							$('input.trigger-change-repeater').trigger('change')                         
							  
                    });
                }         
                }
                       }
        });
	</script>
@endpush
