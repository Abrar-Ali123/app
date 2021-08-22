@extends('admin.layouts.app', ['title' => 'Orders'])

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
                            <li class="breadcrumb-item active">{{__('admin.orders')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.orders')}}</h4>
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
                                    <th>{{__('admin.order')}} ID</th>
                                    <th>{{__('admin.products')}}</th>
                                    <th>{{__('admin.date')}}</th>
                                    <th>{{__('admin.order_type')}}</th>
                                    <th>{{__('admin.payment_method')}}</th>
                                    <th>{{__('admin.total')}}</th>
                                    <th style="width: 250px;">{{__('admin.order_status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>

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
                                        <td>$  {{round($order['total'], 2)}}</td>
                                        <td>
                                            @if(\App\Models\Order::isPaymentConfirm($order['status']))
                                                 <a href="{{route('admin.orders.show',['id'=>$order['id']])}}"><span class="text-primary">{{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</span></a>
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
