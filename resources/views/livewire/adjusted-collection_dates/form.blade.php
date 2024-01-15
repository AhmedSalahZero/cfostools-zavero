@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection
    <div>
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{ __('Adjusted Collection Dates') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <div x-data="{ saved: false }" x-init="
                        @this.on('store', () => {
                            if (saved === false) setTimeout(() => { saved = false }, 2500);
                            saved = true;
                        })
                    " x-show.transition.out.duration.1000ms="saved" style="display: none; font-size: 1rem;" class="alert alert-success" role="alert">
                            {{ __('Item Saved!') }}
                </div>
                <form action="" wire:submit.prevent="store" method="POST" class="kt-form kt-form--label-right">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __('Adjusted Collection Date Section') }}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>{{ __('Adjusted Collection Date') }} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date">
                                            <input type="date" wire:model="date" name="date" class="form-control" />
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    @error('date') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-submitting />
                </form>

                <!--end::Form-->

                <!--end::Portlet-->
            </div>
        </div>

        {{-- Info --}}
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label" style="display: block;">
                            <div>
                                <h4 class="kt-portlet__head-title text-primary spacing">
                                    {{ __('Customer Name : SQUAD ') }}
                                </h4>

                            </div>

                            <div>
                                <h4 class="kt-portlet__head-title text-primary spacing">
                                    {{ __('Invoice Number :  10002123') }}
                                </h4>
                            </div>

                            <div>
                                <h4 class="kt-portlet__head-title text-primary spacing">
                                    {{ __('Invoice Due Date :  30-June-2021') }}
                                </h4>
                            </div>

                            <div>
                                <h4 class="kt-portlet__head-title text-primary spacing">
                                    {{ __('Invoice Net Amount : 1,000,000') }}
                                </h4>
                            </div>

                            <div>
                                <h4 class="kt-portlet__head-title text-primary spacing">
                                    {{ __('Invoice Currency :  USD') }}
                                </h4>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@section('js')
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <!--end::Page Scripts -->
@endsection
