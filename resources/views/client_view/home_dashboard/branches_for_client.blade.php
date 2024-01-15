@extends('layouts.dashboard')
@section('css')
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


@endsection
@section('content')

    <div class="row">

        <!--begin:: Widgets/Activity-->
        @foreach ($company->branches_with_sections as $branch)
            <div class="col-md-4 col-lg-4 col-xl-4 order-lg-1 order-xl-1 ">

                <a href="{{route('set.branch',$branch)}}">
                    <div
                        class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                        <div
                            class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x d-flex justify-content-center">
                            <div class="kt-portlet__head-label company-name">
                                <h3 class="kt-portlet__head-title  " style="color: #000000">
                                    <i class="fas fa-building"></i>
                                    {{ $company->name[$lang] }}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit ">
                            <div class="kt-widget17" style="align-items: center;">
                                <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides company-section"
                                {{-- assets/css/demo3/images/{{ $branch->type }}.jpg --}}
                                    style=" background-image: url('{{url('assets/css/demo3/images/single.jpg')}}') ;    background-position: center;
                                    background-size: cover; ">
                                    <div class="kt-widget17__chart d-flex justify-content-center">
                                        <span class="kt-widget17__desc">
                                            {{$branch->name[$lang] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
@endsection
@section('js')
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@endsection
