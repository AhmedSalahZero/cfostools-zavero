
                                            <div class="col-md-4">
                                                <x-form.select  :add-new-modal="true" :add-new-modal-modal-type="'freelancer-expenses'" :add-new-modal-modal-name="'Position'" :add-new-modal-modal-title="__('Position')" :is-select2="false" :options="$positions" :add-new="false"  :label="__('Position')" class="''" data-filter-type="{{ $type }}" :all="false" name="freelancer_position_id" id="{{$type.'_'.'freelancer_position_id' }}"  :selected-value="isset($freelancerExpense) ? $freelancerExpense->getPositionId(): 0 " ></x-form.select>
                                            </div>
                                           <div class="col-md-2">
                                               <label class="form-label font-weight-bold">{{ __('As % Of Price') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-percentage-allowed freelancer-total-cost-calculations-class percentage-summation" name="freelancer_percentage" value="{{ isset($freelancerExpense) ? $freelancerExpense->getFreelancerPercentageOfPrice() : old('freelancer_percentage',0) }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                           <div class="col-md-2">
                                               <label class="form-label font-weight-bold">{{ __('Working Days') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed freelancer-total-cost-calculations-class " name="freelancer_working_days" value="{{ isset($freelancerExpense) ? $freelancerExpense->getWorkingDays() : old('freelancer_working_days',0) }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                                 <div class="col-md-2">
                                                      <label class="form-label font-weight-bold">{{ __('Cost Per Day') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed freelancer-total-cost-calculations-class " name="freelancer_cost_per_day" value="{{ isset($freelancerExpense) ? $freelancerExpense->getCostPerDay() : old('freelancer_cost_per_day',0) }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 



                                                   <div class="col-md-2">
                                                      <label class="form-label font-weight-bold">{{ __('Total Cost') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input id="tetsid" readonly  class="form-control disabled-custom total-cost-summation" name="freelancer_total_cost" value="{{ isset($freelancerExpense) ? $freelancerExpense->getTotalCost() : old('freelancer_total_cost',0) }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 
