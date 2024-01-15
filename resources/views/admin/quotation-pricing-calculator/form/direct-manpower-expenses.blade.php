                                         <x-form.wrapper class="col-lg-3 col-md-4">
                                             {{-- must have all --}}
                                              <x-form.select  :options="[]" :add-new="false"  :label="__('Service Item')" :is-select2="false" class="repeater-select service_item_class  service-item-class-append" data-filter-type="{{ $type }}" :all="true" name="service_item_id" id="{{$type.'_'.'service_item_id' }}"  :selected-value="isset($quotationPricingCalculator) ? $quotationPricingCalculator->getServiceItemId() : 0" ></x-form.select>
                                        </x-form.wrapper>
                                        

                                    <div class="col-lg-3 col-md-3">
                                                
                                                <x-form.select :is-select2="false" :options="$positions" :add-new="false"  :label="__('Position')" class="" data-filter-type="{{ $type }}" :all="false" name="manpower_expense_position_id" id="{{$type.'_'.'manpower_expense_position_id' }}"  :selected-value="isset($directManpowerExpense) ? $directManpowerExpense->getPositionId() : 0" ></x-form.select>

                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                         
                                           <div class="col-lg-2 col-md-3">
                                               <label>{{ __('Working Days') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed total-cost-calculations-class working-days" name="manpower_expense_working_days" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getWorkingDays() : old('manpower_expense_working_days') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                                 <div class="col-lg-2 col-md-3">
                                                      <label>{{ __('Cost Per Day') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed total-cost-calculations-class cost-per-day" name="manpower_expense_cost_per_day" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getCostPerDay() : old('manpower_expense_cost_per_day') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 



                                                   <div class="col-lg-2 col-md-3">
                                                      <label>{{ __('Total Cost') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input  readonly  class="form-control disabled-custom total-cost-summation" name="manpower_expense_total_cost" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getTotalCost() : old('manpower_expense_total_cost') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 