

                       <div class="col-md-3 mb-4">
                           
						   {{-- {{ dd($salesAndMarketingExpense->) }} --}}
						   <x-form.select :add-new-modal="true" :add-new-modal-modal-type="'sales-and-market-expense'" :add-new-modal-modal-name="'PricingExpense'" :add-new-modal-modal-title="__('Sales And Marketing Expense')" :is-select2="false" :options="$salesAndMarketExpenses??[]" :add-new="false"  :label="__('Sales And Market Expense')" class="" data-filter-type="{{ $type }}" :all="false" name="expense_id" id="{{$type.'_'.'name' }}"  :selected-value="isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getName() : 0" ></x-form.select>
                                                <div class="d-md-none m--margin-bottom-10"></div>
												
                            {{-- <label class="form-label font-weight-bold">{{ __('Name') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getName() : old('name') }}"  >
                                </div>
                            </div> --}}
                        </div>


                       <div class="col-md-2 mb-4">
                           
                            <label class="form-label font-weight-bold">{{ __('As Percentage Of Price %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-percentage-allowed percentage-summation" name="smex_expense_percentage" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getPercentageOfPrice() : old('smex_expense_percentage') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                         <div class="col-md-2 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Cost Per Unit') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed smex-total-cost-class" name="smex_cost_per_unit" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getCostPerUnit() : old('smex_cost_per_unit') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Units Count') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed smex-total-cost-class" name="smex_units_count" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getUnitCost() : old('smex_units_count') }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Total Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="smex_total_cost" value="{{ isset($salesAndMarketingExpense) ? $salesAndMarketingExpense->getTotalCost() : old('smex_total_cost') }}"  step="any" >
                                </div>
                            </div>
                        </div>
