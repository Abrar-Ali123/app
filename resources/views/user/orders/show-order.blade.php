@extends('user.layouts.app', ['title' => 'Edit Order'])

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
                            <li class="breadcrumb-item"><a
                                    href="{{route('user.orders.index')}}">{{__('user.orders')}}</a></li>
                            <li class="breadcrumb-item active">{{__('user.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.edit')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('user.order')}} #{{$order['id']}} </h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('user.product_name')}}</th>
                                    <th>{{__('user.products')}}</th>
                                    <th>{{__('user.quantity')}}</th>
                                    <th>{{__('user.price')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order['carts'] as $cart)
                                    <tr>
                                        <td>{{$cart['p_name']}}</td>
                                        <td>
                                            <div>
                                                @if(count($cart->product->productImages)!=0)
                                                    <img
                                                        src="{{asset('storage/'.$cart->product->productImages[0]['url'])}}"
                                                        style="object-fit: cover" alt="OOps"
                                                        height="64px"
                                                        width="64px">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                         style="object-fit: cover" alt="OOps"
                                                         height="64px"
                                                         width="64px">
                                                @endif

                                                {{\App\Helpers\ProductUtil::getProductItemFeatures($cart->productItem)}}

                                            </div>
                                        </td>
                                        <td>
                                            {{$cart['quantity']}}
                                        </td>
                                        @if($cart['p_offer']==0)
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{$cart['p_price']}}</td>
                                        @else
                                            <td>

                                                <div>
                                                    <span
                                                        style="font-size: 16px">{{\App\Helpers\AppSetting::$currencySign}} {{\App\Models\Product::getDiscountedPrice($cart['p_price'],$cart['p_offer'])}} </span>
                                                    <span
                                                        style="font-size: 12px;text-decoration: line-through;margin-left: 4px">{{\App\Helpers\AppSetting::$currencySign}} {{$cart['p_price']}}</span>
                                                </div>
                                            </td>

                                        @endif

                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.sub_total')}}</th>
                                    <td>
                                        <div
                                            class="font-weight-bold">{{\App\Helpers\AppSetting::$currencySign}} {{$order['order']}}</div>
                                    </td>
                                </tr>

                                @if($order['coupon_discount'])
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="text-right">{{__('user.coupon_discount')}}</th>
                                        <td>
                                            <div>
                                                -{{\App\Helpers\AppSetting::$currencySign}} {{$order['coupon_discount']}}</div>
                                        </td>
                                    </tr>
                                @endif


                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.delivery_fee')}}</th>
                                    <td>{{\App\Helpers\AppSetting::$currencySign}} {{round($order['delivery_fee'], 2)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.tax')}}</th>
                                    <td>{{\App\Helpers\AppSetting::$currencySign}} {{$order['tax']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.total')}}</th>
                                    <td>
                                        <div
                                            class="font-weight-bold">{{\App\Helpers\AppSetting::$currencySign}} {{round($order['total'], 2)}}</div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">


                @if(\App\Models\Order::isOrderTypePickup($order['order_type']))
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{__('user.order_status')}}</h4>
                            <div class="track-order-list mt-4">
                                <ul class="list-unstyled">
                                    @if(\App\Models\Order::isCancelStatus($order['status']))
                                        <p class="text-danger mt-2">{{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</p>
                                    @elseif($order['status']<5)
                                        @for($i=1;$i<4;$i++)
                                            <li class=" @if($i<$order['status']) completed @endif">
                                                @if($i==$order['status'])
                                                    <span class="active-dot dot"></span>
                                                @endif
                                                <h5 class="mt-0 mb-4">{{\App\Models\Order::getTextFromStatus($i,$order['order_type'])}}</h5>
                                            </li>
                                        @endfor
                                    @elseif($order['status']==5)
                                        <p class="text-success mt-2">{{__('manager.this_order_has_been_delivered')}}</p>
                                    @elseif($order['status']==6)
                                        <p class="text-success mt-2">{{__('manager.this_order_has_been_delivered_and_rated')}}</p>
                                    @endif
                                </ul>
                                <div class="row">
                                    <div class="col text-right">

                                        @if(\App\Models\Order::isOrderCompleted($order->status))
                                            <form action="{{route('user.order.review.show',['id'=>$order['id']])}}"
                                                  method="get" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="{{\App\Models\Order::$ORDER_CANCELLED_BY_USER}}">
                                                <button type="submit"
                                                        class="btn w-sm btn-outline-primary waves-effect waves-light ml-2">{{__('user.review')}}
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{route('user.orders.index')}}">
                                            <button type="button"
                                                    class="btn w-sm btn-light waves-effect">{{__('user.go_to_orders')}}
                                            </button>
                                        </a>

                                        @if(\App\Models\Order::isCancellable($order->status))
                                            <form action="{{route('user.orders.update',['id'=>$order['id']])}}"
                                                  method="post" class="d-inline">
                                                @csrf
                                                {{method_field('PATCH')}}
                                                <input type="hidden" name="status" value="{{\App\Models\Order::$ORDER_CANCELLED_BY_USER}}">
                                                <button type="submit"
                                                        class="btn w-sm btn-danger waves-effect waves-light ml-2">{{__('user.cancel')}}
                                                </button>
                                            </form>
                                        @endif

                                            @if(\App\Models\Order::isOrderReadyForDelivery($order->status))
                                                <form action="{{route('user.orders.update',['id'=>$order['id']])}}"
                                                      method="post" class="d-inline">
                                                    @csrf
                                                    {{method_field('PATCH')}}
                                                    <input type="hidden" name="status" value="{{\App\Models\Order::$ORDER_DELIVERED}}">
                                                    <button type="submit"
                                                            class="btn w-sm btn-danger waves-effect waves-light ml-2">{{__('user.pickup_order')}}
                                                    </button>
                                                </form>
                                            @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{__('user.order_status')}}</h4>
                            <div class="track-order-list mt-4">
                                <ul class="list-unstyled">
                                    @if(\App\Models\Order::isCancelStatus($order['status']))
                                        <p class="text-danger mt-2">{{\App\Models\Order::getTextFromStatus($order['status'],$order['order_type'])}}</p>

                                    @elseif($order['status']<5)
                                        @for($i=1;$i<5;$i++)
                                            <li class=" @if($i<$order['status']) completed @endif">
                                                @if($i==$order['status'])
                                                    <span class="active-dot dot"></span>
                                                @endif
                                                <h5 class="mt-0 mb-4">{{\App\Models\Order::getTextFromStatus($i,$order['order_type'])}}</h5>
                                            </li>
                                        @endfor
                                    @elseif($order['status']==5)
                                        <p class="text-success mt-2">{{__('manager.this_order_has_been_delivered')}}</p>
                                    @elseif($order['status']==6)
                                        <p class="text-success mt-2">{{__('manager.this_order_has_been_delivered_and_rated')}}</p>
                                    @endif
                                </ul>
                                <div class="row">
                                    <div class="col text-right">

                                        @if(\App\Models\Order::isOrderCompleted($order->status))
                                            <form action="{{route('user.order.review.show',['id'=>$order['id']])}}"
                                                  method="get" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn w-sm btn-outline-primary waves-effect waves-light ml-2">{{__('user.review')}}
                                                </button>
                                            </form>
                                        @endif


                                        <a href="{{route('user.orders.index')}}">
                                            <button type="button"
                                                    class="btn w-sm btn-light waves-effect ml-2">{{__('user.go_to_orders')}}
                                            </button>
                                        </a>

                                        @if(\App\Models\Order::isCancellable($order->status))
                                            <form action="{{route('user.orders.update',['id'=>$order['id']])}}"
                                                  method="post" class="d-inline">
                                                @csrf
                                                {{method_field('PATCH')}}
                                                <input type="hidden" name="status" value="{{\App\Models\Order::$ORDER_CANCELLED_BY_USER}}">
                                                <button type="submit"
                                                        class="btn w-sm btn-danger waves-effect waves-light ml-2">{{__('user.cancel')}}
                                                </button>
                                            </form>
                                        @endif


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif


            </div>

        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('user.shipping_information')}}</h4>
                        <h5 class="font-family-primary font-weight-semibold">{{$order['user']['name']}}</h5>
                        @if(\App\Models\Order::isOrderTypePickup($order['order_type']))
                            <p class="mb-2"><span
                                    class="font-weight-semibold mr-2">{{\App\Models\Order::getTextFromOrderType($order['order_type'])}}
                            </p>
                        @else
                            <p class="mb-2"><span
                                    class="font-weight-semibold mr-2">{{__('user.address')}}:</span>{{$order['address']['address']}} {{$order['address']['city']}} {{$order['address']['pincode']}}
                            </p>
                        @endif
                        <p class="mb-2"><span
                                class="font-weight-semibold mr-2">{{__('user.email')}}:</span> {{$order['user']['email']}}
                        </p>
                        @if(! \App\Models\Order::isOrderTypePickup($order['order_type']))
                            <a target="_blank" class="mt-1"
                               href="{{\App\Models\Order::generateGoogleMapLocationUrl($order['address']['latitude'],$order['address']['longitude'])}}">
                                <button type="button"
                                        class="btn w-sm btn-outline-primary waves-effect">{{__('user.delivery_location')}}
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('user.billing_information')}}</h4>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <p class="mb-2"><span
                                        class="font-weight-bold mr-2">{{__('user.OTP')}} :</span> {{$order['otp']}}
                                </p>
                                <p class="mb-2"><span
                                        class="font-weight-bold mr-2">{{__('user.payment_type')}} :</span> {{\App\Models\Order::getTextFromPaymentType($order->orderPayment->payment_type)}}
                                </p>
                            </li>
                        </ul>

                    </div>
                </div>
            </div> <!-- end col -->

            @if(!\App\Models\Order::isOrderTypePickup($order['order_type']))
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{__('user.delivery_boy')}}</h4>
                            @if($order->deliveryBoy)
                                <div class="text-center">
                                    <img src="{{asset('/storage/'.$order->deliveryBoy->avatar_url)}}"
                                         class="img-fluid rounded-circle"
                                         alt="" height="44px" width="44px"/>
                                    <h5><b>{{$order['delivery_boy']['name']}}</b></h5>
                                    <p class="mb-1"><span
                                            class="font-weight-semibold">{{__('user.email')}} :</span> {{$order->deliveryBoy->email}}
                                    </p>
                                    <p class="mb-2"><span
                                            class="font-weight-semibold">{{__('user.phone')}} :</span> {{$order->deliveryBoy->mobile}}
                                    </p>
                                    <a target="_blank"
                                       href="{{\App\Models\Order::generateGoogleMapLocationUrl($order->deliveryBoy->latitude,$order->deliveryBoy->longitude)}}">
                                        <button
                                                class="btn w-sm btn-outline-primary waves-effect">{{__('user.order_location')}}
                                        </button>
                                    </a>
                                </div>
                            @else
                                <div class="text-center">
                                    <h5>{{__('user.delivery_boy_is_not_assign_yet')}}</h5>
                                </div>
                            @endif

                        </div>
                    </div>
                </div> <!-- end col -->
            @endif
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
