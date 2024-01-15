<div class="kt-portlet">
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row btn-for-submit--js {{ isset($isHidden)&&$isHidden ? 'd-none':'' }}">
                <div class="col-lg-6">
                    {{-- <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                </div>
                <div class="col-lg-6 kt-align-right">
                    {{-- <input  type="submit" class="btn active-style save-form" value="{{ __('Save And Complete Later') }}"> --}}
                    <input  type="submit" class="btn active-style save-form" value="{{ __('Save & Go To Next') }}">
                </div>
            </div>
        </div>
    </div>
</div>
