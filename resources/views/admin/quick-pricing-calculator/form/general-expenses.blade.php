

  <div class="col-md-3 mb-4">
					   <x-form.select :add-new-modal="true" :add-new-modal-modal-type="'general-and-administrative-expense'" :add-new-modal-modal-name="'PricingExpense'" :add-new-modal-modal-title="__('General Expense ')" :is-select2="false" :options="$generalExpenses??[]" :add-new="false"  :label="__('General Expenses')" class="" data-filter-type="{{ $type }}" :all="false" name="expense_id" id="{{$type.'_'.'name' }}"  :selected-value="isset($generalExpense) ? $generalExpense->getName() : 0" ></x-form.select>
                                                <div class="d-md-none m--margin-bottom-10"></div>
												    
                            {{-- <label class="form-label font-weight-bold">{{ __('Name') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" value="{{ isset($generalExpense) ? $generalExpense->getName() : old('name') }}"  >
                                </div>
                            </div> --}}
                        </div>

  <div class="col-md-2 mb-4">
                           
                            <label class="form-label font-weight-bold">{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="gaex_expense_percentage" value="{{ isset($generalExpense) ? $generalExpense->getPercentageOfPrice() : old('gaex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>

                        
                         <div class="col-md-2 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed gaex-total-cost-class" name="gaex_cost_per_unit" value="{{ isset($generalExpense) ? $generalExpense->getCostPerUnit() : old('gaex_cost_per_unit') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed gaex-total-cost-class" name="gaex_units_count" value="{{ isset($generalExpense) ? $generalExpense->getUnitCost() : old('gaex_units_count') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="gaex_total_cost" value="{{ isset($generalExpense) ? $generalExpense->getTotalCost() : old('gaex_total_cost') }}"  step="any" >
                                </div>
                            </div>
                        </div>
