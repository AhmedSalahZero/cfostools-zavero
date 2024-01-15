
                       <div class="col-md-3 mb-4">
                           
                            <label>{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="smex_expense_percentage" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getPercentageOfPrice() : old('smex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                         <div class="col-md-3 mb-4">
                            <label>{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed smex-total-cost-class" name="smex_cost_per_unit" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getCostPerUnit() : old('smex_cost_per_unit') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label>{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed smex-total-cost-class" name="smex_units_count" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getUnitCost() : old('smex_units_count') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label>{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="smex_total_cost" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getTotalCost() : old('smex_total_cost') }}"  step="any" >
                                </div>
                            </div>
                        </div>