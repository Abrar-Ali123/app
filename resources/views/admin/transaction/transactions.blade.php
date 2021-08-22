@extends('admin.layouts.app', ['title' => 'Transactions'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('admin.transactions')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.transactions')}}</h4>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                @if($transactions->count()>0)
                    <div class="row justify-content-between mx-1">
                        <h4>{{__('admin.payment')}}</h4>
                        {{ $transactions->links() }}
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered  table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="8" class="text-center">{{__('admin.payment')}}</th>
                                        <th colspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="2" class="text-center">{{__('admin.admin')}}</th>
                                        <th colspan="3" class="text-center">{{__('admin.shop')}}</th>
                                        <th colspan="3" class="text-center">{{__('admin.delivery_boy')}}</th>
                                        <th colspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th>{{__('admin.order')}} ID</th>
                                        <th>{{__('admin.admin_revenue')}}</th>

                                        <th>{{__('admin.shop')}}</th>
                                        <th>{{__('admin.delivery_boy')}}</th>

                                        <th>{{__('admin.shop_id')}}</th>
                                        <th>{{__('admin.admin')}}</th>
                                        <th>{{__('admin.delivery_boy')}}</th>

                                        <th>{{__('admin.delivery_boy_id')}}</th>
                                        <th>{{__('admin.admin')}}</th>
                                        <th>{{__('admin.shop')}}</th>

                                        <th>{{__('admin.total')}}</th>


                                        <th style="width: 82px;">{{__('admin.action')}}</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <a href="{{route('admin.orders.show',['id'=>$transaction['order']['id']])}}"
                                                   class="font-weight-semibold"># {{$transaction['order']['id']}}</a>
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['admin_revenue'])}}
                                            </td>

                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['admin_to_shop'] ?? 0)}}</td>
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['admin_to_delivery_boy'])}}</td>

                                            <td>
                                                <a href="{{route('admin.shops.show',['id'=>$transaction['shop_id']])}}"
                                                   class="font-weight-semibold"># {{$transaction['shop_id']}}</a></td>
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['shop_to_admin'])}}</td>
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['shop_to_delivery_boy'] ?? 0)}}</td>

                                            @if($transaction['delivery_boy_id'])
                                                <td>
                                                    <a href="{{route('admin.delivery-boys.index')}}"
                                                       class="font-weight-semibold"># {{$transaction['delivery_boy_id']}}</a>
                                                </td>

                                                <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['delivery_boy_to_admin'])}}</td>
                                                <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['delivery_boy_to_shop'] ?? 0)}}</td>
                                            @else
                                                <td colspan="3" class="text-center">
                                                    <span class="text-muted ">{{__('admin.no_delivery_boy')}}</span>
                                                </td>
                                            @endif

                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['total'])}}</td>


                                            <td>
                                                @if(\App\Models\Order::isCancelStatus($transaction['order']['status']))
                                                    @if(\App\Models\Order::isPaymentByCOD($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-primary">{{__('admin.order_cancelled')}}</span>
                                                    @elseif(\App\Models\Order::isPaymentByPaystack($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-danger">Manually refund from paystack</span>\
                                                    @elseif(\App\Models\Order::isPaymentByStripe($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-danger">Manually refund from stripe</span>
                                                    @elseif(\App\Models\Order::isPaymentByRazorpay($transaction['orderPayment']['payment_type']))
                                                        @if($transaction['refunded'])
                                                            <span
                                                                class="text-danger">{{__('admin.payment_refunded')}}</span>
                                                        @elseif($transaction->orderPayment->success)
                                                            <form
                                                                action="{{route('admin.transaction.refund',['id'=>$transaction->id])}}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-danger">{{__('admin.refund')}}</button>
                                                            </form>
                                                        @else
                                                            <span
                                                                class="text-danger">{{__('admin.order_cancelled_by_user')}}</span>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if(\App\Models\Order::isPaymentByCOD($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-primary">{{__('admin.collected_by_shop')}}</span>
                                                    @elseif(\App\Models\Order::isPaymentByPaystack($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-primary">Capture payment from paystack</span>
                                                    @elseif(\App\Models\Order::isPaymentByStripe($transaction['orderPayment']['payment_type']))
                                                        <span
                                                            class="text-primary">Capture payment from stripe</span>

                                                    @elseif(\App\Models\Order::isPaymentByRazorpay($transaction['orderPayment']['payment_type']))
                                                        @if($transaction['captured'])
                                                            <span
                                                                class="text-success">{{__('admin.payment_captured')}}</span>
                                                        @else
                                                            <form
                                                                action="{{route('admin.transaction.capture',['id'=>$transaction->id])}}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-primary">{{__('admin.capture')}}</button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h3>{{__('admin.there_is_no_any_revenues_yet')}}</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($shops->count()>0)
                    <h4>{{__('admin.shop_transaction')}}</h4>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{__('admin.shop_id')}}</th>
                                        <th>{{__('admin.shop_name')}}</th>
                                        <th>{{__('admin.total_pay_to_shop')}}</th>
                                        <th>{{__('admin.total_pay_to_admin')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shops as $shop)
                                        <tr>
                                            <td>
                                                <a href="{{route('admin.shops.show',['id'=>$shop['id']])}}"
                                                   class="font-weight-semibold"># {{$shop['id']}}</a>
                                            </td>
                                            <td><a href="{{route('admin.shops.show',['id'=>$shop['id']])}}"
                                                   class="font-weight-semibold">{{$shop['name']}}</a>
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($shop['total_admin_to_shop'])}}
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($shop['total_shop_to_admin'])}}
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h3>{{__('admin.there_is_no_any_revenues_yet')}}</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($deliveryBoys->count()>0)
                    <h4>{{__('admin.delivery_boy_transaction')}}</h4>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{__('admin.shop_id')}}</th>
                                        <th>{{__('admin.delivery_boy')}}</th>
                                        <th>{{__('admin.total_pay_to_delivery_boy')}}</th>
                                        <th>{{__('admin.total_pay_to_admin')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deliveryBoys as $deliveryBoy)
                                        <tr>
                                            <td>
                                                <a href="{{route('admin.delivery-boys.index')}}"
                                                   class="font-weight-semibold"># {{$deliveryBoy['id']}}</a>
                                            </td>
                                            <td><a href="{{route('admin.delivery-boys.index')}}"
                                                   class="font-weight-semibold">{{$deliveryBoy['name']}}</a>
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($deliveryBoy['total_admin_to_delivery_boy'])}}
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($deliveryBoy['total_delivery_boy_to_admin'])}}
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h3>{{__('admin.there_is_no_any_revenues_yet')}}</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>


    </div>

@endsection

@section('script')

@endsection
