<input
															data-has-row-total="0"
										data-max-row-total="0"
										data-has-column-total="1"
										data-max-column-total="100"
										data-is-percentage="1"
										data-no-digits="1"
										
															 type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}"  onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size"  data-year="{{ $year }}" >
															<input data-column-identifier="{{ $year }}" type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" name="payload[{{ $currentSectionName }}][{{ $instance }}][{{ $year }}]" >
															