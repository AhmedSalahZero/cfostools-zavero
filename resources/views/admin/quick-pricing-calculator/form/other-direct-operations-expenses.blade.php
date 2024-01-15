 <div class="col-md-3 mb-4">

 <x-form.select :add-new-modal="true" :add-new-modal-modal-type="'other-direct-operations-expense'" :add-new-modal-modal-name="'PricingExpense'" :add-new-modal-modal-title="__('Other Direct Operations Expense')" :is-select2="false" :options="$otherDirectOperationsExpenses??[]" :add-new="false"  :label="__('Other Variable Manpower Expense')" class="" data-filter-type="{{ $type }}" :all="false" name="expense_id" id="{{$type.'_'.'name' }}"  :selected-value="isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getName() : 0" ></x-form.select>
                                                <div class="d-md-none m--margin-bottom-10"></div>
												
     {{-- <label class="form-label font-weight-bold">{{ __('Name') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="text" class="form-control " name="name" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getName() : old('name') }}" >
         </div>
     </div> --}}
 </div>
 <div class="col-md-2 mb-4">

     <label class="form-label font-weight-bold">{{ __('As Percentage Of Price %') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-percentage-allowed percentage-summation" name="direct_opex_expense_percentage" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getPercentageOfPrice() : old('direct_opex_expense_percentage') }}" step="any">
         </div>
     </div>
 </div>


 <div class="col-md-2 mb-4">
     <label class="form-label font-weight-bold">{{ __('Cost Per Unit') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-greater-than-or-equal-zero-allowed direct-opex-total-cost-class" name="direct_opex_cost_per_unit" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getCostPerUnit() : old('direct_opex_cost_per_unit') }}" step="any">
         </div>
     </div>
 </div>


 <div class="col-md-2 mb-4">
     <label class="form-label font-weight-bold">{{ __('Units Count') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-greater-than-or-equal-zero-allowed direct-opex-total-cost-class" name="direct_opex_units_count" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getUnitCost() : old('direct_opex_units_count') }}" step="any">
         </div>
     </div>
 </div>


 <div class="col-md-3 mb-4">
     <label class="form-label font-weight-bold">{{ __('Total Cost') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="direct_opex_total_cost" value="{{ isset($otherDirectOperationExpense) ? $otherDirectOperationExpense->getTotalCost() : old('direct_opex_total_cost') }}" step="any">
         </div>
     </div>
 </div>
