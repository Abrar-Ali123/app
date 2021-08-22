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
                            <li class="breadcrumb-item active">{{__('user.payment')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.payment')}}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">

                            <div class="col-lg-6">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered table-nowrap mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{__('user.image')}}</th>
                                                <th>{{__('user.product_name')}}</th>
                                                <th>{{__('user.price')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->carts as $cart)
                                                <tr>
                                                    <td>
                                                        @if(count($cart->product['productImages'])!=0)
                                                            <img
                                                                src="{{asset('storage/'.$cart->product['productImages'][0]['url'])}}"
                                                                style="object-fit: cover" alt="OOps"
                                                                height="64px"
                                                                width="64px"
                                                                class="img-fluid"
                                                            >
                                                        @else
                                                            <img
                                                                src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                                style="object-fit: cover" alt="OOps" height="48"
                                                                class="img-fluid">
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href=""
                                                           class="text-body font-weight-semibold">{{$cart->product->name}}</a>
                                                        <br>
                                                        {{\App\Helpers\ProductUtil::getProductItemFeatures($cart->productItem)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{\App\Helpers\CurrencyUtil::getCurrencySign(true)}}{{\App\Helpers\CurrencyUtil::getDiscountedPrice($cart->productItem->price,$cart->product->offer,true)}}
                                                        <small class="d-block">{{$cart->quantity}} {{__('user.quantity')}}</small>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr class="text-right">
                                                <td colspan="2" class="font-weight-bolder">
                                                    {{__('user.sub_total')}}
                                                </td>
                                                <td class="text-right">
                                                        {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->order)}}
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="2" class="font-weight-bolder">
                                                    {{__('user.coupon_discount')}}
                                                </td>
                                                <td class="text-right">
                                                    - {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->coupon_discount)}}
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="2" class="font-weight-bolder">
                                                    {{__('user.tax')}}
                                                </td>
                                                <td class="text-right">
                                                    {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->tax)}}
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="2" class="font-weight-bolder">
                                                    {{__('user.delivery_fee')}}
                                                </td>
                                                <td class="text-right">
                                                    {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->delivery_fee)}}
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="2" class="font-weight-bolder text-dark">
                                                    {{__('user.total')}}
                                                </td>
                                                <td class="text-right text-dark font-weight-bold" >
                                                    {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($order->total)}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-sm-6">
                                            <div class="text-sm-left mt-2 mt-sm-0">
                                                <button id="cancelOrderBtn"
                                                        class="btn btn-danger">
                                                    <i class="mdi mdi-window-close mr-1"></i> {{__('user.cancel_order')}} </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-sm-right mt-2 mt-sm-0">
                                                <form method="POST" action="{{ route('user.orders_payment.paystack.pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                                    @csrf
                                                    <input type="hidden" name="email" value={{auth()->user()->email}}> {{-- required --}}
                                                    <input type="hidden" name="amount" value={{$order->total * 100}}> {{-- required in kobo --}}
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="currency" value="ZAR">
                                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['order_id' => $order->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}

                                                    <button
                                                            class="btn btn-success">
                                                        <i class="mdi mdi-credit-card mr-1"></i> {{__('user.pay')}} with paystack </button>
                                                </form>


                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end table-responsive -->
                            </div> <!-- end col-->
                            <!-- end col-->
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
        </div>


    </div> <!-- container -->

@endsection
