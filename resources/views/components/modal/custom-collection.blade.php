@props([
'id',
'tableId',
'isRepeater',
'subModel'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Custom Collection') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="customize-elements">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('Payment Rate %') }}</th>
                                <th class="text-center">{{ __('Due In Days') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($rateIndex= 0 ;$rateIndex<6 ; $rateIndex++) <tr>
                                <td>
								{{-- {{ dd($subModel) }} --}}
                                    <input class="form-control only-percentage-allowed rate-element" value="{{ isset($subModel) ? $subModel->getPaymentRate($rateIndex) :  0 }}" placeholder="{{ __('Rate') .  ' ' . $rateIndex }}">
                                    <input multiple class="rate-element-hidden" type="hidden" value="{{ (isset($subModel) ? $subModel->getPaymentRate($rateIndex) : 0) }}" name="@if($isRepeater)payment_rate @else {{ $tableId }}[0][payment_rate] @endif">
                                </td>
                                <td>
								<div class="max-w-selector-popup">
                                    <x-form.select :maxOptions="1" multiple :selectedValue="isset($subModel) ? $subModel->getPaymentRateAtDueInDays($rateIndex) : '' " :options="getDueInDays()" :add-new="false" class="select2-select  js-due_in_days repeater-select"  :all="false" name="@if($isRepeater) due_days @else {{ $tableId }}[0][due_days] @endif" id="{{$tableId.'-'.'dueInDays' }}"></x-form.select>
								</div>
                                </td>
                                </tr>
                                @endfor
								<tr style="border-top:1px solid gray;padding-top:5px;text-align:center">
									<td class="td-for-total-payment-rate">
										0
									</td>
									<td>-</td>
								</tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Save') }}</button>
                {{-- <button type="button" class="btn btn-primary">{{ __('Save changes') }}</button> --}}
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
//    $('#' + "{{ $id }}").modal('show');
</script>
@endpush
