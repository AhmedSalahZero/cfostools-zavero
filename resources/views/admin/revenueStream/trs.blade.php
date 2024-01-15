     @for($instance=0 ; $instance< $noRows ; $instance++) 
                    <tr>
                       
						<td style="{{  }}">
                            {{ $instance+1 }}
                        </td>
						
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <input type="text" class="form-control placeholder-light-gray exclude-text" name="name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Name...') }}">
                            {{-- <input type="hidden" class="form-control placeholder-light-gray" name="old_name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}"> --}}
                        </td>
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <input name="products_count[{{ $instance }}]" style="width:max-content !important;" type="numberic" class="form-control only-greater-than-zero-allowed placeholder-light-gray trigger-change-when-start" value="{{ $directExpense ? $directExpense->getName():null }}" placeholder="{{ __('Please Enter Count.') }}">
                        </td>

                    </tr>


                    @endfor
