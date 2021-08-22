@extends('admin.layouts.app', ['title' => 'Edit App Data'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.categories.index')}}">{{__('admin.app_data')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.app_data')}}</h4>
                </div>
            </div>
        </div>

        <form action="{{route('admin.appdata.create')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('admin.version')}}</h5>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label
                                            for="application_minimum_version">{{__('admin.application_minimum_version')}}</label>
                                        <input type="number"
                                               class="form-control @if($errors->has('application_minimum_version')) is-invalid @endif"
                                               id="application_minimum_version"
                                               placeholder="{{__('admin.application_minimum_version')}}"
                                               name="application_minimum_version"
                                               value="{{$appData->application_minimum_version}}">
                                        @if($errors->has('application_minimum_version'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('application_minimum_version') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('admin.payment_method')}}</h5>
                            <p class="card-text">{{__('admin.you_can_enable_or_disable_payment_methods')}}</p>

                            <div class="row">
                                <div class="col-12 col-md-12 mt-1">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" name="stripe" id="stripe"
                                               @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_STRIPE)) checked @endif
                                        >
                                        <label class="custom-control-label" for="stripe">Stripe</label>
                                    </div>
                                </div>


                                <div class="col-12 col-md-12 mt-2">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" name="razorpay"
                                               id="razorpay"
                                               @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_RAZORPAY)) checked @endif
                                        >
                                        <label class="custom-control-label" for="razorpay">Razorpay</label>
                                    </div>
                                </div>


                                <div class="col-12 col-md-12 mt-2">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" name="paystack"
                                               id="paystack"
                                               @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_PAYSTACK)) checked @endif >
                                        <label class="custom-control-label" for="paystack">Paystack</label>
                                    </div>
                                </div>


                                <div class="col-12 col-md-12 mt-2">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" name="cash_on_delivery"
                                               id="cash_on_delivery"
                                               @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_COD)) checked @endif >
                                        <label class="custom-control-label"
                                               for="cash_on_delivery">{{__('admin.cash_on_delivery')}}</label>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-1">{{__('admin.update')}}
                    </button>
                </div>
            </div>

        </form>

    </div>
@endsection

@section('script')
@endsection
