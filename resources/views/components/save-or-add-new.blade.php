@props([
	'title',
	'addNewBtnTitle',
	'addNewBtnLink',
	'nextFFE'=>null
])
<div class="kt-portlet">
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row btn-for-submit--js ">
                <div class="col-lg-6">
                    {{-- <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                </div>
                <div class="col-lg-6 kt-align-right">
					@if(isset($nextFFE))
                    <input  data-redirect-to-next-ffe="1"  type="submit" class="btn active-style save-form" value="{{ __('Save & Go To Next FFE') }}">
					@endif 
                    <input  data-redirect-to-same-page="1"  type="submit" class="btn active-style save-form" value="{{ $addNewBtnTitle }}">
                    <input  type="submit" class="btn active-style save-form" value="{{ $title }}">
                </div>
            </div>
        </div>
    </div>
</div>
