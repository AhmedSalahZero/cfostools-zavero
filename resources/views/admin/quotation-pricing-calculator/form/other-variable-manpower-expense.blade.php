 <div class="col-md-3 mb-4">
                           
                            <label>{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation " name="variable_mp_expense_percentage" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getPercentageOfPrice() : old('variable_mp_expense_percentage',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>


                         <div class="col-md-3 mb-4">
                            <label>{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed  mp-total-cost-class" name="mp_cost_per_unit" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getCostPerUnit() : old('mp_cost_per_unit',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <label>{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed mp-total-cost-class" name="mp_units_count" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getUnitCost() : old('mp_units_count',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label>{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="mp_total_cost" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getTotalCost() : old('mp_total_cost',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>
