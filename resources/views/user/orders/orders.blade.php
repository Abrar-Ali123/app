@extends('user.layouts.app', ['title' => 'Checkout'])

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
                            <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('user.orders')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.orders')}}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Products</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Order Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td class=" font-weight-bold">#{{$order->id}}</td>
                                        <td>
                                            @foreach($order->carts as $cart)
                                                @if(count($cart->product['productImages'])!=0)
                                                    <img src="{{asset('storage/'.$cart->product['productImages'][0]['url'])}}" height="32">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}" height="32">
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> {{\App\Helpers\DateTimeUtil::convertToDateText($order['created_at'])}}
                                            <small
                                                class="text-muted">{{\App\Helpers\DateTimeUtil::convertToTimeText($order['created_at'])}}</small>
                                        </td>
                                        <td>
                                            {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->total)}}
                                        </td>
                                        <td>
                                            {{\App\Models\Order::getTextFromPaymentType($order->orderPayment->payment_type)}}
                                        </td>
                                        <td>
                                            @if(\App\Models\Order::isCancelStatus($order['status']))
                                                <span
                                                    class="text-danger">{{ \App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</span>
                                            @elseif(\App\Models\Order::isPaymentConfirm($order['status']))
                                                <a href="{{route('user.orders.show',['id'=>$order['id']])}}"> {{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</a>
                                            @else
                                                <a class="text-danger" href="{{route('user.orders_payment.index',['id'=>$order['id']])}}"> {{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>

        <div class="float-right">
            {{$orders->links()}}</div>

    </div> <!-- container -->

@endsection

@section('script')
@endsection
