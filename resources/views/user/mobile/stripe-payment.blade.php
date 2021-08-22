<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.shared/title-meta', ['title' => "Stripe Payment"])
    @include('user.layouts.shared/head-css')
    {{--@include('layouts.shared/head-css', ["demo" => "dark"])--}}
    <style>
        .stripe-button-el{
            display: none !important;
        }
    </style>
</head>

<body >
<!-- Begin page -->
<div id="wrapper">
    <div class="container">
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

                                <div class="mt-4 text-right">
                                    <form method="POST" action="{{ route('user.mobile.orders_payment.stripe.callback') }}" id="callbackForm">
                                        <input name="order_id" value="{{$order->id}}" hidden>
                                        @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js"
                                            class="stripe-button"
                                            data-key="{{\App\Helpers\AppSetting::$STRIPE_PUBLIC_KEY}}"
                                            data-name="Order"
                                            data-description="Pay"
                                            data-amount="{{\App\Helpers\CurrencyUtil::doubleToString($order->total) *100}}"
                                            data-currency="{{\App\Helpers\AppSetting::$currencyCode}}"
{{--                                                    data-zip-code="required"--}}
{{--                                                    data-billing-address="required"--}}>
                                        </script>
                                        <button type="submit"
                                                class="btn btn-success">
                                            <i class="mdi mdi-credit-card mr-1"></i> {{__('user.pay')}} with stripes </button>
                                    </form>

                                </div>
                                <!-- end table-responsive -->
                            </div> <!-- end col-->
                            <!-- end col-->
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
        </div>


    </div> <
    <!-- content -->

    @include('user.layouts.shared/footer')
</div>


@include('user.layouts.shared/footer-script')

</body>

<script>



</script>
</html>
