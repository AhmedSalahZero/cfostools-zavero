 <div class="col-md-3 mb-4">
          <x-form.select :add-new-modal="true" :add-new-modal-modal-name="'PricingExpense'" :add-new-modal-modal-type="'other-variable-direct-manpower-expense'"  :add-new-modal-modal-title="__('Other Variable Manpower Expense')" :is-select2="false" :options="$otherVariableManpowerExpenses??[]" :add-new="false"  :label="__('Other Variable Manpower Expense')" class="" data-filter-type="{{ $type }}" :all="false" name="expense_id" id="{{$type.'_'.'name' }}"  :selected-value="isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getName() : 0" ></x-form.select>
                                                <div class="d-md-none m--margin-bottom-10"></div>

     {{-- <label class="form-label font-weight-bold">{{ __('Name') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="text" class="form-control" name="name" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getName() : old('name') }}" step="any">
         </div>
     </div> --}}
 </div>
 
 <div class="col-md-2 mb-4">

     <label class="form-label font-weight-bold">{{ __('As Percentage Of Price %') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-percentage-allowed percentage-summation " name="variable_mp_expense_percentage" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getPercentageOfPrice() : old('variable_mp_expense_percentage',0) }}" step="any">
         </div>
     </div>
 </div>


 <div class="col-md-2 mb-4">
     <label class="form-label font-weight-bold">{{ __('Cost Per Unit') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-greater-than-or-equal-zero-allowed  mp-total-cost-class" name="mp_cost_per_unit" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getCostPerUnit() : old('mp_cost_per_unit',0) }}" step="any">
         </div>
     </div>
 </div>

 <div class="col-md-2 mb-4">
     <label class="form-label font-weight-bold">{{ __('Units Count') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="number" class="form-control only-greater-than-or-equal-zero-allowed mp-total-cost-class" name="mp_units_count" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getUnitCost() : old('mp_units_count',0) }}" step="any">
         </div>
     </div>
 </div>


 <div class="col-md-3 mb-4">
     <label class="form-label font-weight-bold">{{ __('Total Cost') }} </label>
     <div class="kt-input-icon">
         <div class="input-group">
             <input type="text" readonly class="form-control  disabled-custom total-cost-summation" name="mp_total_cost" value="{{ isset($otherVariableManpowerExpense) ? $otherVariableManpowerExpense->getTotalCost() : old('mp_total_cost',0) }}" step="any">
         </div>
     </div>
 </div>
