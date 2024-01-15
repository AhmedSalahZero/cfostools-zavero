
                      
                       <div class="col-md-4 mb-4">
                           
                            <label class="form-label font-weight-bold">{{ __('Corporate Taxes %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="corporate_taxes_percentage" type="number" class="form-control only-percentage-allowed" name="corporate_taxes_percentage" value="{{ isset($profitability) ? $profitability->getCorporateTaxesPercentage() : old('corporate_taxes_percentage',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>


                         <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Net Profit After Taxes %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="net_profit_after_taxes_percentage" type="number" class="form-control only-percentage-allowed ebt-calc" name="net_profit_after_taxes_percentage" value="{{ isset($profitability) ? $profitability->getNetProfitAfterTaxes() : old('net_profit_after_taxes_percentage',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('VAT %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="vat-percentage" type="number" class="form-control only-greater-than-or-equal-zero-allowed " name="vat_percentage" value="{{ isset($profitability) ? $profitability->getVat() : old('vat_percentage',0) }}"  step="any" >
                                </div>
                            </div>
                        </div>
