@extends('manager.layouts.app', ['title' => 'Coupons'])

@section('css')
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css"/>
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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('manager.coupons')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.coupons')}}</h4>
                </div>
            </div>
        </div>


        <form action="{{route('manager.coupons.update')}}" method="post" id="couponForm">
            @csrf
            {{method_field('PATCH')}}
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" data-plugin="dragula"
                                 data-containers='["remaining-coupons", "my-shop-coupons"]'
                                 data-handleClass="dragula-handle">
                                <div class="col-md-6">

                                    <div class="bg-light p-2 p-lg-4">
                                        <h5 class="mb-3 mt-0 text-center">Remaining coupons</h5>

                                        <div id="remaining-coupons" class="py-2" style="min-height: 400px;">
                                            @foreach($unSelectedCoupons as $unSelectedCoupon)
                                                <div class="card border rounded" data-id="{{$unSelectedCoupon['id']}}">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h5 class="mb-1 mt-0">
                                                                    #{{$unSelectedCoupon['code']}}</h5>
                                                                <p class="mb-1">
                                                                    - {{$unSelectedCoupon['description']}}</p>
                                                                <p class="mb-0 text-muted">
                                                                    <span class="font-13">Expired at {{\Carbon\Carbon::parse($unSelectedCoupon['expired_at'])->setTimezone(\App\Helpers\AppSetting::$timezone)->format('M d Y')}}</span>
                                                                </p>
                                                            </div> <!-- end media-body -->
                                                            <span class="dragula-handle"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="bg-light p-2 p-lg-4">
                                        <h5 class="mb-3 mt-0 text-center">My shop coupons</h5>

                                        <div id="my-shop-coupons" class="py-2" style="min-height: 400px;">
                                            @foreach($selectedCoupons as $selectedCoupon)
                                                <div class="card border rounded" data-id="{{$selectedCoupon['id']}}">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h5 class="mb-1 mt-0">#{{$selectedCoupon['code']}}</h5>
                                                                <p class="mb-1">
                                                                    - {{$selectedCoupon['description']}}</p>
                                                                <p class="mb-0 text-muted">
                                                                    <span class="font-13">Expired at {{\Carbon\Carbon::parse($selectedCoupon['expired_at'])->setTimezone(\App\Helpers\AppSetting::$timezone)->format('M d Y')}}</span>
                                                                </p>
                                                            </div> <!-- end media-body -->
                                                            <span class="dragula-handle"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div> <!-- end company-list-2-->
                                </div> <!-- end col -->

                            </div> <!-- end row -->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div>


                <div class="col-12">
                    <div class="text-right mb-3">
                        <a href="javascript:history.go(0)" type="button"
                           class="btn w-sm btn-light waves-effect">{{__('manager.cancel')}}</a>
                        <button type="button" id="submitBtn"
                                class="btn w-sm btn-primary waves-effect waves-light">{{__('manager.save')}}</button>
                    </div>
                </div>

            </div>
        </form>


    </div> <!-- container -->

@endsection

@section('script')


    <script>
        const btn = document.getElementById('submitBtn');
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedSection = document.getElementById('my-shop-coupons').children;
            const form = document.getElementById('couponForm');
            selectedSection.forEach(function (item, index) {
                const selectedCouponInput = document.createElement("input");
                selectedCouponInput.setAttribute("type", "hidden");
                selectedCouponInput.setAttribute("name", "coupons[]");
                selectedCouponInput.setAttribute("value", item.getAttribute("data-id"));
                form.appendChild(selectedCouponInput);
            });
            form.submit();
        });
    </script>



    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>


    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/dragula/dragula.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/dragula.init.js')}}"></script>


@endsection

