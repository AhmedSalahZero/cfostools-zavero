@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
<style>
    .ui-datepicker-calendar {
        display: none;
    }

</style>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Plan Table') }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($model) ? route('admin.update.plan',[$company->id , $model->id]) : $storeRoute  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">


            <div class="kt-portlet">


                <div class="kt-portlet__body">

                    <h2 for="" class="d-block">{{ __('Plan Information') }}</h2>



                    <div class="form-group row">

                        <div class="col-md-12 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Plan Name') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('Please Enter Plan Name') }}" name="study_name" value="{{ isset($hospitalitySector) ? $hospitalitySector->getStudyName() : null }}" required>
                                </div>
                            </div>
                        </div>





                        {{-- <div class="col-md-4 mb-4">
                            <x-form.select :options="[
																		'single'=>['title'=>'Single','value'=>0],
																		'multiple'=>['title'=>'Multiple','value'=>1],
																	  ]" :add-new="false" :is-required="true" :label="__('Type')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="is_main" id="{{$type.'_'.'property_status' }}" :selected-value="isset($model) ? $model->getPropertyStatus() : 0"></x-form.select>
                        </div> --}}






              

                 


                 
                        <br>
                        <hr>

                    </div>
                </div>
            </div>











    </div>
</div>







<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Is Multiple ?') }} </h3>

                    <input class="can-be-toggle-show-repeater-btn" data-repeater-query=".multiple-repeater" type="checkbox" name="is_multiple" value="1" style="width:20px;height:20px" @if(isset($model) && $model->hasSalesChannels()) checked @elseif(!isset($model)) @endif >
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".multiple-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3" data-repeater-row=".multiple-repeater">
                    <div class="row">





                    </div>

                    <div id="m_repeater_8" class="multiple-repeater">
                        <div class="form-group  m-form__group row">
                            <div data-repeater-list="sub_items" class="col-lg-12">

                                @if(isset($model) && $model->subHospitalitySectors->count() )
                                @foreach($model->subHospitalitySectors as $index=>$subHospitalitySector)
                                @include('admin.hospitality-sector.sub_items-repeater' , [
                                'index'=>$index,
								'subHospitalitySector'=>$subHospitalitySector
                                ])
                                @endforeach
                                @else
                                @include('admin.hospitality-sector.sub_items-repeater' , [
                                'index'=>0
                                ])

                                @endif


                            </div>
                        </div>
                        <div class="m-form__group form-group row">

                            <div class="col-lg-6">
                                <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                                    <span>
                                        <i class="fa fa-plus"> </i>
                                        <span>
                                            {{ __('Add') }}
                                        </span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>














<div class="kt-portlet">
    <div class="kt-portlet__body">
        <x-save :btn-text="__('Create')" />
    </div>
</div>




<!--end::Form-->

<!--end::Portlet-->
</div>


</div>

</div>




</div>









</div>
</div>
</form>

</div>
@endsection
@section('js')
<x-js.commons></x-js.commons>

<script>
    $(document).on('click', '.save-form', function(e) {
        e.preventDefault(); {

            let form = document.getElementById('form-id');
            var formData = new FormData(form);
            $('.save-form').prop('disabled', true);

            $.ajax({
                cache: false
                , contentType: false
                , processData: false
                , url: form.getAttribute('action')
                , data: formData
                , type: form.getAttribute('method')
                , success: function(res) {
                    $('.save-form').prop('disabled', false)

                    Swal.fire({
                        icon: 'success'
                        , title: res.message,

                    });

                    window.location.href = res.redirectTo;




                }
                , complete: function() {
                    $('#enter-name').modal('hide');
                    $('#name-for-calculator').val('');

                }
                , error: function(res) {
                    $('.save-form').prop('disabled', false);
                    $('.submit-form-btn-new').prop('disabled', false)
                    Swal.fire({
                        icon: 'error'
                        , title: res.responseJSON.message
                    , });
                }
            });
        }
    })

</script>
<script>
 $(document).on('change', '.can-be-toggle-show-repeater-btn', function() {
        let val = $(this).is(':checked')
        let repeaterQuery = $(this).attr('data-repeater-query')
        if (!val) {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').addClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeOut(300)
            $(this).val(0)
        } else {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').removeClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeIn(300)
            $(this).val(1)

        }

    })
    $('.can-be-toggle-show-repeater-btn').trigger('change')
	

</script>
@endsection
