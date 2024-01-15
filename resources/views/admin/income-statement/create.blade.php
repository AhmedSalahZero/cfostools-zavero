@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Income Statement') }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST"  enctype="multipart/form-data"  action="{{  isset($disabled) && $disabled ? '#' : (isset($model) ? route('admin.update.income.statment',[$company->id , $model->id]) : $storeRoute)  }}" >

        @csrf
                <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
                <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}" >
                {{-- <input type="hidden" id="current_state_id" name="current_state_id" data-state-id="{{ isset($model) ? $model->getStateId() : 0  }}"> --}}
                {{-- <input type="hidden" id="current_service_item_id" name="current_service_item_id" data-value="{{ isset($model) ? $model->getServiceItemId() : 0  }}"> --}}
                {{-- <input type="hidden" id="current_service_category_id" name="current_service_category_id" data-value="{{ isset($model) ? $model->getServiceCategoryId() : 0  }}"> --}}
                {{-- <input type="hidden" id="name-for-calculator" name="name"> --}}
            <div class="kt-portlet">
          
                
                <div class="kt-portlet__body">

                            <h2 for="" class="d-bloxk mb-4">{{ __('Income Statement Information') }}</h2>
                   

                 
                    <div class="form-group row">

                        <div class="col-md-3 mb-4">
                            <label>{{ __('Name') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="name" type="text" required class="form-control" name="name" value="{{ isset($model) ? $model->getName() : old('name') }}"  >
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-md-3 mb-4">
                            <label>{{ __('Duration') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="duration" type="number" class="form-control only-greater-than-zero-allowed" name="duration" value="{{ isset($model) ? $model->getDuration() : old('duration') }}"  step="1" >
                                </div>
                            </div>
                        </div>
                      
                      
                        <div class="col-md-3 mb-4">

                                  <x-form.select :options="$durationTypes" :add-new="false"  :label="__('Duration Type')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="duration_type" id="{{$type.'_'.'duration_type' }}"  :selected-value="isset($model) ? $model->getDurationType() : 0" ></x-form.select>
                        </div>

                        <div class="col-md-3 mb-4">
                            
                           <x-form.label :class="'label'" :id="'test-id'">{{ __('Start From') }}</x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
													<input  type="text" name="start_from" class="form-control"  value="{{ isset($model) ? $model->getStartFrom() : getCurrentDateForFormDate('date') }}"  id="kt_datepicker_3" />
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar"></i>
														</span>
													</div>
												</div>
                            </div>
                        </div>


                    



                        

                        <br>
                        <hr>

                    </div>
                </div>
            </div>

                  <x-create :btn-text="__('Create')"  />



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

        $(document).on('click','.save-form',function(e){
            e.preventDefault();
            {

                let form = document.getElementById('form-id');
            var formData = new FormData(form);
                    $('.save-form').prop('disabled',true );
                    // console.log(form);
            $.ajax({
                   cache:false,
            contentType: false,
            processData: false,
                url:form.getAttribute('action'),
                data:formData,
                type:form.getAttribute('method'),
                success:function(res){
                    $('.save-form').prop('disabled',false)

                     Swal.fire({
                            icon: 'success',
                            title: res.message,
                        
                        });

                        window.location.href=res.redirectTo;
                        

                    

                },
                complete:function(){
                    $('#enter-name').modal('hide');
                    $('#name-for-calculator').val('');

                },
                error:function(res){
                    $('.submit-form-btn-new').prop('disabled',false)
                        Swal.fire({
                            icon: 'error',
                            title: res.responseJSON.message,
                        });
                }
            });
            }
        })
</script>
@endsection
