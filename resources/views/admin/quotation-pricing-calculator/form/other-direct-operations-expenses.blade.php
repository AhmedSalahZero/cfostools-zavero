
                          <x-form.wrapper class="col-lg-4 col-md-4">
                                             {{-- must have all --}}
                                                  <x-form.select  :options="[]" :add-new="false"  :label="__('Service Item')" :is-select2="false" class="repeater-select service_item_class  service-item-class-append" data-filter-type="{{ $type }}" :all="true" name="service_category_id" id="{{$type.'_'.'service_category_id' }}"  :selected-value="isset($quotationPricingCalculator) ? $quotationPricingCalculator->getServiceCategoryId() : 0" ></x-form.select>
                                            </x-form.wrapper>

                       <div class="col-lg-2 col-md-3 ">
                           
                            <label>{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="direct_opex_expense_percentage" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getPercentageOfPrice() : old('direct_opex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                         <div class="col-lg-2 col-md-3 ">
                            <label>{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed direct-opex-total-cost-class" name="direct_opex_cost_per_unit" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getCostPerUnit() : old('direct_opex_cost_per_unit') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-2 col-md-3 ">
                            <label>{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed direct-opex-total-cost-class" name="direct_opex_units_count" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getUnitCost() : old('direct_opex_units_count') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-2 col-md-3">
                            <label>{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="direct_opex_total_cost" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getTotalCost() : old('direct_opex_total_cost') }}"  step="any" >
                                </div>
                            </div>
                        </div>