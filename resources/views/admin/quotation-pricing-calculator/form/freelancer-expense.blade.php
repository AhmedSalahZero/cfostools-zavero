                                            <x-form.wrapper class="col-lg-4 col-md-4">
                                             {{-- must have all --}}
                                                  <x-form.select  :options="$serviceItems" :add-new="false"  :label="__('Service Item')" :is-select2="false" class="repeater-select service_item_class  service-item-class-append" data-filter-type="{{ $type }}" :all="true" name="service_category_id" id="{{$type.'_'.'service_category_id' }}"  :selected-value="isset($quotationPricingCalculator) ? $quotationPricingCalculator->getServiceCategoryId() : 0" ></x-form.select>
                                            </x-form.wrapper>

                                            <div class="col-md-4">
                                                <x-form.select :is-select2="false" :options="$positions" :add-new="false"  :label="__('Position')" class="''" data-filter-type="{{ $type }}" :all="false" name="freelancer_position_id" id="{{$type.'_'.'freelancer_position_id' }}"  :selected-value="isset($freelancerExpense) ? $freelancerExpense->getPositionId(): 0 " ></x-form.select>
                                            </div>
                                           <div class="col-lg-4 col-md-2">
                                               <label>{{ __('As % Of Price') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-percentage-allowed freelancer-total-cost-calculations-class percentage-summation" name="freelancer_percentage" value="{{ isset($freelancerExpense) ? $freelancerExpense->getFreelancerPercentageOfPrice() : old('freelancer_percentage') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                           <div class="col-lg-4 col-md-2">
                                               <label>{{ __('Working Days') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed freelancer-total-cost-calculations-class " name="freelancer_working_days" value="{{ isset($freelancerExpense) ? $freelancerExpense->getWorkingDays() : old('freelancer_working_days') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                                 <div class="col-lg-4 col-md-2">
                                                      <label>{{ __('Cost Per Day') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed freelancer-total-cost-calculations-class " name="freelancer_cost_per_day" value="{{ isset($freelancerExpense) ? $freelancerExpense->getCostPerDay() : old('freelancer_cost_per_day') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 



                                                   <div class="col-lg-4 col-md-2">
                                                      <label>{{ __('Total Cost') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input id="tetsid" readonly  class="form-control disabled-custom total-cost-summation" name="freelancer_total_cost" value="{{ isset($freelancerExpense) ? $freelancerExpense->getTotalCost() : old('freelancer_total_cost') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 