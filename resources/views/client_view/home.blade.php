@extends('layouts.dashboard')
@section('css')
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


@endsection
@section('content')

    <div class="row">

        <!--begin:: Widgets/Activity-->
     

    </div>

    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        {{-- <div class="kt-portlet__head-label">

                        </div> --}}
                    </div>

                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                <div class="kt-widget5">
                                    <div class="kt-widget5__item">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__pic">
                                                <img class="kt-widget7__img" src="{{$company->getFirstMediaUrl()}}" alt="">
                                            </div>
                                            <div class="kt-widget5__section">
                                                <a href="{{ route('home.redirect', $company) }}" class="kt-widget5__title">
                                                    {{$company->name[$lang]}}
                                                </a>

                                                {{-- <div class="kt-widget5__info">
                                                    <span>Author:</span>
                                                    <span class="kt-font-info">Keenthemes</span>
                                                    <span>Released:</span>
                                                    <span class="kt-font-info">23.08.17</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            {{-- <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">19,200</span>
                                                <span class="kt-widget5__sales">sales</span>
                                            </div>
                                            <div class="kt-widget5__stats">
                                                <span class="kt-widget5__number">1046</span>
                                                <span class="kt-widget5__votes">votes</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@endsection
