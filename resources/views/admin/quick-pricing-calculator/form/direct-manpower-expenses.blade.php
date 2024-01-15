<div class="col-md-3">
                                                
                                                <x-form.select :add-new-modal="true" :add-new-modal-modal-type="'direct-manpower-expense'" :add-new-modal-modal-name="'Position'" :add-new-modal-modal-title="__('Position')" :is-select2="false" :options="$positions" :add-new="false"  :label="__('Position')" class="" data-filter-type="{{ $type }}" :all="false" name="manpower_expense_position_id" id="{{$type.'_'.'manpower_expense_position_id' }}"  :selected-value="isset($directManpowerExpense) ? $directManpowerExpense->getPositionId() : 0" ></x-form.select>

                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                           <div class="col-md-3">
                                               <label>{{ __('Working Days') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed total-cost-calculations-class working-days" name="manpower_expense_working_days" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getWorkingDays() : old('manpower_expense_working_days') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 

                                                 <div class="col-md-3">
                                                      <label>{{ __('Cost Per Day') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control only-greater-than-zero-allowed total-cost-calculations-class cost-per-day" name="manpower_expense_cost_per_day" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getCostPerDay() : old('manpower_expense_cost_per_day') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 



                                                   <div class="col-md-3">
                                                      <label>{{ __('Total Cost') }} </label>
                                                    <div class="kt-input-icon">
                                                        <div class="input-group">
                                                            <input  readonly  class="form-control disabled-custom total-cost-summation" name="manpower_expense_total_cost" value="{{ isset($directManpowerExpense) ? $directManpowerExpense->getTotalCost() : old('manpower_expense_total_cost') }}"  step="any" >
                                                        </div>
                                                    </div>
                                                </div> 
