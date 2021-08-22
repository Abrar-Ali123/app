@extends('manager.layouts.app', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.dashboard')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.dashboard')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-9">
                <div class="card-box pb-2">
                    <div class="float-right d-none d-md-inline-block">
                        <h4 class="header-title mb-3">{{__('manager.current_week')}}</h4>
                    </div>

                    <h4 class="header-title mb-3">{{__('manager.sales_analytics')}}</h4>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('manager.weekly_orders')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                                <span>{{$total_weekly_orders}}</span>
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('manager.weekly_selling')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                <span>{{$total_weekly_products}}</span>
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('manager.weekly_revenue')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                <span>${{$total_weekly_revenue}}</span>
                            </h2>
                        </div>
                    </div>
                    {{$chart->container()}}

                </div> <!-- end card-box -->
            </div>
            <div class="col-xl-3">
                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{$revenue}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('manager.total_revenue')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-basket font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$orders_count}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('manager.orders')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-store font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$products_count}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('manager.products_sell')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ $chart->cdn() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}

    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>
@endsection
