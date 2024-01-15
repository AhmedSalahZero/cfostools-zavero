  <div class="col-md-3 mb-4">
                           
                            <label>{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="gaex_expense_percentage" value="{{ isset($generalExpense) ? $generalExpense->getPercentageOfPrice() : old('gaex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>

                        
                         <div class="col-md-3 mb-4">
                            <label>{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed gaex-total-cost-class" name="gaex_cost_per_unit" value="{{ isset($generalExpense) ? $generalExpense->getCostPerUnit() : old('gaex_cost_per_unit') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label>{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed gaex-total-cost-class" name="gaex_units_count" value="{{ isset($generalExpense) ? $generalExpense->getUnitCost() : old('gaex_units_count') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label>{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="gaex_total_cost" value="{{ isset($generalExpense) ? $generalExpense->getTotalCost() : old('gaex_total_cost') }}"  step="any" >
                                </div>
                            </div>
                        </div>
