
                          <x-form.wrapper class="col-lg-6 col-md-4">
                                             {{-- must have all --}}
                                                  <x-form.select  :options="$serviceItems" :add-new="false"  :label="__('Service Item')" :is-select2="false" class="repeater-select service_item_class  service-item-class-append" data-filter-type="{{ $type }}" :all="true" name="service_category_id" id="{{$type.'_'.'service_category_id' }}"  :selected-value="isset($quotationPricingCalculator) ? $quotationPricingCalculator->getServiceCategoryId() : 0" ></x-form.select>
                                            </x-form.wrapper>

                       <div class="col-lg-6 col-md-3 ">
                           
                            <label>{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="direct_opex_expense_percentage" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getPercentageOfPrice() : old('direct_opex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>
