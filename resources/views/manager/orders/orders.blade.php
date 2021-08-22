@extends('manager.layouts.app', ['title' => 'Orders'])

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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('manager.orders')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.orders')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">


                        <div class="float-right">
                            {{ $orders->links() }}
                        </div>


                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('manager.order')}} ID</th>
                                    <th>{{__('manager.products')}}</th>
                                    <th>{{__('manager.date')}}</th>
                                    <th>{{__('manager.order_type')}}</th>
                                    <th>{{__('manager.payment_method')}}</th>
                                    <th>{{__('manager.total')}}</th>
                                    <th style="width: 250px;">{{__('manager.order_status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr href="{{route('manager.orders.edit',['id'=>$order['id']])}}">

                                        <td><span class=" text-body font-weight-bold">#{{$order['id']}}</span></td>

                                        <td>
                                            <div>
                                                @foreach($order['carts'] as $cart)
                                                    @if(count($cart['product']['productImages'])!=0)
                                                        <img src="{{asset('storage/'.$cart['product']['productImages'][0]['url'])}}"
                                                             style="object-fit: cover" alt="OOps"
                                                             height="64px"
                                                             width="64px">
                                                    @else
                                                        <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                             style="object-fit: cover" alt="OOps" class="m-1"
                                                             height="60px"
                                                             width="60px">
                                                    @endif
                                                @endforeach

                                            </div>
                                        </td>
                                        <td> {{\Carbon\Carbon::parse($order['created_at'])->setTimezone(\App\Helpers\AppSetting::$timezone)->format('M d Y')}}
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($order['created_at'])->setTimezone(\App\Helpers\AppSetting::$timezone)->format('h:i A')}}</small>
                                        </td>
                                        <td>{{\App\Models\Order::getTextFromOrderType($order['order_type'])}}</td>
                                        <td>{{\App\Models\Order::getTextFromPaymentType($order['orderPayment']['payment_type'])}}</td>
                                        <td>$ {{round($order['total'], 2)}}</td>
                                        <td>
                                            @if(\App\Models\Order::isCancelStatus($order['status']))
                                                <span
                                                    class="text-danger">{{ \App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</span>
                                            @elseif(\App\Models\Order::isPaymentConfirm($order['status']))
                                                <a href="{{route('manager.orders.edit',['id'=>$order['id']])}}"> {{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</a>
                                            @else
                                                <span
                                                    class="text-danger">{{ \App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</span>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
