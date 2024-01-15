{{-- {{ start of collection policy section }} --}}
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Collection Terms') }}
                    </h3>
                    <div class="form-group mb-0" style="margin-left:auto;margin-right:auto">
                        <div class="kt-radio-inline">
                            <label class="mr-3">

                            </label>

                            <label class="kt-radio kt-radio--success ">
                                <input @if($onlyGeneralExpense) disabled @endif id="collection-terms-per-sales-channel-id" type="radio" name="{{ $modelName }}_collection_policy_type" value="terms_per_sales_channel" class="collection-radio-class" @if( $isCollectionTermPerItem ) checked @endisset>
                                <label for="collection-terms-per-sales-channel-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                    {{ $collectionPolicyFirstLabel }}
                                </label>

                                <span></span>
                            </label>

                            <label class="kt-radio kt-radio--success ">
                                <input @if($onlyGeneralExpense) selected @endif type="radio" id="gerenal-collection-terms-id" value="general_collection_terms" name="{{ $modelName }}_collection_policy_type" class="collection-radio-class" @if(!$isCollectionTermPerItem) checked @endisset>
                                <label for="gerenal-collection-terms-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                    {{ __('General Collection Terms') }}
                                </label>
                                <span></span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".collection-rate-section">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row collection-rate-section">


            <div class="table-responsive" data-name="per-sales-channel-collection">
                <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 table-for-collection-policy">
                    <thead>
                        <tr>
                            <th class="text-center">{{ $firstHeader }}</th>
                            <th class="text-center">{{ __('System Default') }}</th>
                            <th class="text-center">{{ __('Customized Terms') }}</th>
                        </tr>
                    </thead>
                    <tbody class="">

                        @php
                        $currentTotal = [];
                        $subItemIndex=0;

                        @endphp
                        @foreach($collectionPolicyItems as $index=>$salesChannel)
                        @php
                        $salesChannelName = $salesChannel->getName();
                        @endphp

                        <tr>
                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                <b class="pr-6rem">
                                    {{ str_to_upper($salesChannelName) }}
                                </b>
                            </td>
                            @php
                            $order = 1 ;
                            @endphp

                            @foreach(['system_default','customize'] as $collectionPolicyType)
                            <td class="align-middle">

                                @php
                                $currentVal = 0 ;
                                $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;


                                @endphp
                                <div class="form-group three-dots-parent" style="
								
								flex-direction: row !important;
								width:100%;
								gap: 40px !important;
								
								">
								{{-- {{ dd($collectionPolicyType) }} --}}
								{{-- {{ dd($salesChannel->collectionPolicyInterval() ) }} --}}
								{{-- {{ dd($salesChannel,$salesChannel->isSystemDefaultCollectionPolicy()) }} --}}
                                    @if($collectionPolicyType == 'system_default')
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage ">
                                        <input @if( $salesChannel->isSystemDefaultCollectionPolicy()) checked @endif type="radio" style="height:18px !important;width:18px!important;margin-right:20px;" value="1" data-order="{{ $order }}" data-index="{{ $index }}" name="is_system_default[{{ $salesChannelName }}]" class="form-control ">
                                        <select style="width:180px;" name="system_default[{{ $salesChannelName }}]" id="" class="form-control">
                                            @foreach(getDurationIntervalTypesForSelect() as $intervalArray)
                                            <option value="{{ $intervalArray['value'] }}" @if($salesChannel->collectionPolicyInterval() == $intervalArray['value'])
                                                selected
                                                @endif
                                                >{{ $intervalArray['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @elseif($collectionPolicyType =='customize')


                                    <div class="basis-100 for-only-one-checked w-100 " data-item="customize">
                                        <div class="customize-content" style="display:flex;flex-direction:row !important;flex-wrap:wrap !important;width:100%;">
                                            <div class="collection-rate d-flex flex-wrap w-100 mb-2">
                                                <div class="d-flex align-items-center justify-content-center w-100 mb-3">
                                                    <div>
                                                        <input type="radio" style="height:18px !important;width:18px!important;" value="0" @if( $salesChannel->isCustomizeCollectionPolicy()) checked @endif data-order="{{ $order }}" data-index="{{ $index }}" name="is_system_default[{{ $salesChannelName }}]" class="form-control ">
                                                    </div>
                                                    <h5 class=" label form-label mb-0 ml-5" style="white-space:nowrap;">{{ __('Collection Rate %') }} </h5>

                                                </div>
                                                @for($i = 0 ; $i<4 ; $i++) <div class="collection-rate-item mb-3 d-flex align-items-center ">
                                                    <input class="form-control collection_rate_input mr-2 only-percentage-allowed" data-sales-channel-name="{{ $salesChannelName }}" type="text" name="sub_items[{{ $salesChannelName }}][collection_policy][type][value][rate][{{ $i }}]" style="width:140px;" value="{{ $salesChannel->getSalesChannelRateAndDueInDays($i,'rate')??0 }}">
                                                    <span class="percentage-weight">%</span>
                                            </div>
                                            @endfor
                                            <div class="d-flex align-items-center justify-content-center" style="margin-left:10px;margin-bottom:1rem">
                                                <label class="label form-label ">{{ __('Total') }}</label>
                                                <input style="width:140px;margin-left:20px" data-sales-channel-name="{{ $salesChannelName }}" value="{{ $salesChannel->isCustomizeCollectionPolicy()?100:0 }}" class="form-control collection_rate_total_class mr-2" readonly name="sub_items[{{ $order }}][collection_rate_total][{{ $i }}]">
                                                <span class="percentage-weight">%</span>
                                            </div>
                                        </div>
                                        <div class="due-in-days d-flex flex-wrap w-100">
                                            <div class="d-flex align-items-center justify-content-center w-100 mb-3">
                                                <div>
                                                    <input type="radio" style="height:18px !important;width:18px!important;" class="form-control visibility-hidden">
                                                </div>
                                                <h5 class="label form-label mb-0 ml-5">{{ __('Due In Days') }}</h5>
                                            </div>


                                            @for($i=0;$i<4;$i++) <div class="collection-rate-item mb-3  d-flex align-content-center">
                                                <select style="width:140px !important" name="sub_items[{{ $salesChannelName }}][collection_policy][type][value][due_in_days][{{ $i }}]" class="form-control mr-2 ">
                                                    @foreach(dueInDays() as $dueDay)
                                                    <option value="{{ $dueDay }}" @if($salesChannel->getSalesChannelRateAndDueInDays($i,'due_in_days') == $dueDay)
                                                        selected
                                                        @endif

                                                        >{{ $dueDay }}

                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span class="percentage-weight visibility-hidden">%</span>
                                        </div>
                                        @endfor



                                    </div>
                                </div>
            </div>

            @endif
        </div>

        </td>
        @endforeach
        @php
        $order = $order +1 ;
        @endphp
        {{-- @endforeach --}}

        </tr>
        @php
        $subItemIndex = $subItemIndex +1 ;
        @endphp
        @endforeach




        </tbody>
        </table>
    </div>
	
	
	
	
	
	
	
	
	
	<div class="table-responsive" data-name="per-sales-channel-collection" >
                <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 table-for-general-collection-policy">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('Item') }}</th>
                            <th class="text-center">{{ __('System Default') }}</th>
                            <th class="text-center">{{ __('Customized Terms') }}</th>
                        </tr>
                    </thead>
                    <tbody class="">

                        @php
                        $currentTotal = [];
                        $subItemIndex=0;

                        @endphp
                
                        @php
                        $salesChannelName = __('General Collection Policy');
                        @endphp

                        <tr>
                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                <b class="pr-6rem">
                                    {{ str_to_upper($salesChannelName) }}
                                </b>
                            </td>
                            @php
                            $order = 1 ;
                            @endphp

                            @foreach(['system_default','customize'] as $collectionPolicyType)
                            <td class="align-middle">

                                @php
                                $currentVal = 0 ;
                                $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;


                                @endphp
                                <div class="form-group three-dots-parent" style="
								
								flex-direction: row !important;
								width:100%;
								gap: 40px !important;
								
								">
								{{-- {{ dd($model->isGeneralSystemDefaultCollectionPolicyForType($modelName),$collectionPolicyType) }} --}}
                                    @if($collectionPolicyType == 'system_default')
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage ">
                                        <input @if( $model->isGeneralSystemDefaultCollectionPolicyForType($modelName)) checked @endif type="radio" style="height:18px !important;width:18px!important;margin-right:20px;" value="1" data-order="{{ $order }}" data-index="{{ $index }}" name="is_general_system_default" class="form-control ">
                                        <select style="width:180px;" name="general_system_default"  class="form-control">
                                            @foreach(getDurationIntervalTypesForSelect() as $intervalArray)
                                            <option value="{{ $intervalArray['value'] }}" @if($model->generalCollectionPolicyIntervalForType($modelName) == $intervalArray['value'])
                                                selected
                                                @endif
                                                >{{ $intervalArray['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @elseif($collectionPolicyType =='customize')


                                    <div class="basis-100 for-only-one-checked w-100 " data-item="customize">
                                        <div class="customize-content" style="display:flex;flex-direction:row !important;flex-wrap:wrap !important;width:100%;">
                                            <div class="collection-rate d-flex flex-wrap w-100 mb-2">
                                                <div class="d-flex align-items-center justify-content-center w-100 mb-3">
                                                    <div>
                                                        <input type="radio" style="height:18px !important;width:18px!important;" value="0" @if( $model->isGeneralCustomizeCollectionPolicyForType($modelName)) checked @endif data-order="{{ $order }}" data-index="{{ $index }}" name="is_general_system_default" class="form-control ">
                                                    </div>
                                                    <h5 class=" label form-label mb-0 ml-5" style="white-space:nowrap;">{{ __('Collection Rate %') }} </h5>

                                                </div>
                                                @for($i = 0 ; $i<4 ; $i++) <div class="collection-rate-item mb-3 d-flex align-items-center ">
                                                    <input class="form-control collection_rate_input mr-2 only-percentage-allowed" data-sales-channel-name="{{ $salesChannelName }}" type="text" name="sub_items[general_collection_policy][type][value][rate][{{ $i }}]" style="width:140px;" value="{{ $model->getGeneralCollectionPolicyRateAndDueInDays($i,'rate',$modelName)??0 }}">
                                                    <span class="percentage-weight">%</span>
                                            </div>
                                            @endfor
                                            <div class="d-flex align-items-center justify-content-center" style="margin-left:10px;margin-bottom:1rem">
                                                <label class="label form-label ">{{ __('Total') }}</label>
                                                <input style="width:140px;margin-left:20px" data-sales-channel-name="{{ $salesChannelName }}" value="{{ $model->isGeneralCustomizeCollectionPolicyForType($modelName)?100:0 }}" class="form-control collection_rate_total_class mr-2" readonly >
                                                <span class="percentage-weight">%</span>
                                            </div>
                                        </div>
                                        <div class="due-in-days d-flex flex-wrap w-100">
                                            <div class="d-flex align-items-center justify-content-center w-100 mb-3">
                                                <div>
                                                    <input type="radio" style="height:18px !important;width:18px!important;" class="form-control visibility-hidden">
                                                </div>
                                                <h5 class="label form-label mb-0 ml-5">{{ __('Due In Days') }}</h5>
                                            </div>

                                            @for($i=0;$i<4;$i++) <div class="collection-rate-item mb-3  d-flex align-content-center">
                                                <select style="width:140px !important" name="sub_items[general_collection_policy][type][value][due_in_days][{{ $i }}]" class="form-control mr-2 ">
                                                    @foreach(dueInDays() as $dueDay)
                                                    <option value="{{ $dueDay }}" @if($model->getGeneralCollectionPolicyRateAndDueInDays($i,'due_in_days',$modelName) == $dueDay)
                                                        selected
                                                        @endif

                                                        >{{ $dueDay }}

                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span class="percentage-weight visibility-hidden">%</span>
                                        </div>
                                        @endfor



                                    </div>
                                </div>
            </div>

            @endif
        </div>

        </td>
        @endforeach
        @php
        $order = $order +1 ;
        @endphp
        {{-- @endforeach --}}

        </tr>
        @php
        $subItemIndex = $subItemIndex +1 ;
        @endphp
     




        </tbody>
        </table>
    </div>




















</div>

</div>
</div>

@push('js')
<script>
 $(document).on('change', '.collection-radio-class', function() {
            const value = $(this).val();
			
            if (value == 'general_collection_terms') {
				$('.table-for-general-collection-policy').removeClass('d-none')
				$('.table-for-collection-policy').addClass('d-none')
            } else {
				$('.table-for-general-collection-policy').addClass('d-none')
				$('.table-for-collection-policy').removeClass('d-none')
            }
        })

	$('.collection-radio-class:checked').trigger('change')

</script>
@endpush
{{-- end of room collection policy --}}
