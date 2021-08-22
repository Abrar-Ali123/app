@extends('admin.layouts.app', ['title' => 'Dashboard'])

@section('css')

@endsection

@section('content')

    <div class="container-fluid">

        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl col-md-6">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded bg-soft-primary">
                                <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt<span data-plugin="counterup">{{$revenue}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Revenue</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div><!-- end widget-rounded-circle--><!-- end col-->

            <div class="col-xl col-md-6">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded bg-soft-success">
                                <i class=" dripicons-shopping-bag font-24 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$orders_count}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Orders</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-xl col-md-6">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded bg-soft-warning">
                                <i class=" dripicons-user-group font-24 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_delivery_boys}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Delivery boys</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card-box pb-2">
                <div class="float-right d-none d-md-inline-block">
                    <h4 class="header-title mb-3">Current Week</h4>
                </div>

                <h4 class="header-title mb-3">Sales Analytics</h4>

                <div class="row text-center">
                    <div class="col-md-4">
                        <p class="text-muted mb-0 mt-3">Weekly Orders</p>
                        <h2 class="font-weight-normal mb-3">
                            <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                            <span>{{$total_weekly_orders}}</span>
                        </h2>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-0 mt-3">Weekly Revenue</p>
                        <h2 class="font-weight-normal mb-3">
                            <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                            <span>${{$total_weekly_revenue}}</span>
                        </h2>
                    </div>
                </div>
                {{$chart->container()}}

            </div> <!-- end card-box -->
        </div>

    </div>

    </div>

@endsection

@section('script')

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}


    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>
@endsection
