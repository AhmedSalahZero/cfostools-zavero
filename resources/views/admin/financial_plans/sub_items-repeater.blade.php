<div data-repeater-item class="form-group m-form__group row align-items-center repeater_item">
    <div class="col-md-12 mb-4 mt-4">
        <label class="form-label font-weight-bold">{{ __('Name') }} @include('star') </label>
        <div class="kt-input-icon">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ __('Please Enter Sub Study Name') }}" name="sub_item_name" value="{{ isset($subHospitalitySector) ? $subHospitalitySector->getStudyName() : null }}" required>
            </div>
        </div>
    </div>


    <div class="">
        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

        </i>
    </div>

</div>
