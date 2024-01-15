<div data-repeater-item class="form-group m-form__group row align-items-center repeater_item">
    <div class="col-md-6">
        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater sales-channel-js" :is-required="true" :is-select2="false" :options="getSalesChannelsForSelectionForFB()" :add-new="false" :label="__('Choose Sales Channels')" data-filter-type="{{ $type }}" :all="false" name="name" id="{{$type.'_'.'name'.$index }}" :selected-value="isset($salesChannel) ? $salesChannel->getName(): 0 "></x-form.select>
    </div>



    <div class="">
        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

        </i>
    </div>

</div>
