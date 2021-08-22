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
                            <li class="breadcrumb-item active">{{__('user.carts')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.shopping_cart')}}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="nav nav-pills flex-row navtab-bg text-center"
                                     id="v-pills-tab" role="tablist" aria-orientation="horizontal">

                                    <a class="nav-link mt-2 py-2 active col" id="custom-v-pills-shipping-tab"
                                       data-toggle="pill" href="#custom-v-pills-shipping" role="tab"
                                       aria-controls="custom-v-pills-shipping" aria-selected="false">
                                        <i class="mdi mdi-truck-fast d-block font-24"></i>
                                        {{__('user.shipping_information')}}</a>
                                    <a class="nav-link mt-2 py-2 col" id="custom-v-pills-payment-tab" data-toggle="pill"
                                       href="#custom-v-pills-payment" role="tab" aria-controls="custom-v-pills-payment"
                                       aria-selected="false">
                                        <i class="mdi mdi-cash-multiple d-block font-24"></i>
                                        {{__('user.payment_method')}}</a>
                                </div>
                                <div class="tab-content p-3">
                                    <div class="tab-pane fade active show" id="custom-v-pills-shipping" role="tabpanel"
                                         aria-labelledby="custom-v-pills-shipping-tab">
                                        <div>

                                            <h4 class="header-title">{{__('user.shipping_information')}}</h4>


                                            <div class="row mt-3">
                                                <div class="col-md-12">

                                                    <div class="border p-3 rounded mb-3">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pickUpOrderRadio"
                                                                   name="shippingOptions" class="custom-control-input"
                                                                   checked="">
                                                            <label class="custom-control-label font-16 font-weight-bold"
                                                                   for="pickUpOrderRadio">{{__('user.pickup_order')}} -
                                                                {{__('user.FREE')}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="border p-3 rounded">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="homeDeliveryRadio"
                                                                   name="shippingOptions" class="custom-control-input"
                                                                   @if(!$carts[0]->product->shop->available_for_delivery) disabled @endif>
                                                            <label class="custom-control-label font-16 font-weight-bold"
                                                                   for="homeDeliveryRadio">{{__('user.home_delivery')}} @if(!$carts[0]->product->shop->available_for_delivery)
                                                                    <small class="text-danger">
                                                                        ({{__('user.currently_this_shop_is_not_available_for_delivery')}}
                                                                        )</small> @endif</label>
                                                        </div>
                                                        <p class="mb-0 pl-3 pt-1">{{__('user.delivery_charge_based_on_how_far_you_from_shop')}}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="address-section" class="d-none">
                                                <h4 class="header-title mt-4  @if($errors->has('address_id')) is-invalid @endif">{{__('user.saved_address')}}</h4>
                                                @if($errors->has('address_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('address_id') }}</strong>
                                                                        </span>
                                                @endif

                                                <div class="row">
                                                    @foreach($userAddresses as $userAddress)
                                                        <div class="col-md-6 mt-3">
                                                            <div class="border p-3 rounded mb-3 mb-md-0">
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio"
                                                                           id="address-radio-{{$loop->index}}"
                                                                           name="addressRadio"
                                                                           class="custom-control-input "
                                                                           @if(!\App\Helpers\DistanceUtil::isValidForDelivery($carts[0]->product->shop,$userAddress)) disabled @endif>

                                                                    <label
                                                                        class="custom-control-label font-16 font-weight-bold"
                                                                        for="address-radio-{{$loop->index}}">{{__('user.address')}}
                                                                        #{{$loop->index+1}}</label>
                                                                </div>

                                                                <p class="mb-2 mt-2"><span
                                                                        class="font-weight-semibold mr-2">{{__('user.address')}}:</span>
                                                                    {{$userAddress->address}}</p>
                                                                <p class="mb-2"><span class="font-weight-semibold mr-2">{{__('user.pincode')}}:</span>
                                                                    {{$userAddress->city}} - {{$userAddress->pincode}}
                                                                </p>
                                                                <p class="mb-2 @if(\App\Helpers\DistanceUtil::isValidForDelivery($carts[0]->product->shop,$userAddress))text-success @else text-danger @endif">{{__('user.you_are')}} {{\App\Helpers\DistanceUtil::distanceBetweenTwoPoint($carts[0]->product->shop,$userAddress,true)}} {{__('user.far_from_shop')}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-md-6 mt-3">
                                                        <a href="{{route('user.addresses.create')}}">
                                                            <div class="border p-3 rounded mb-3 mb-md-0"
                                                                 style="border-style: dashed !important;">

                                                                <h3 class="text-center">
                                                                    + {{__('user.add_new_address')}}</h3>

                                                            </div>
                                                        </a>
                                                    </div>


                                                </div>
                                                <!-- end row-->
                                            </div>

                                            <!-- end row-->


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-v-pills-payment" role="tabpanel"
                                         aria-labelledby="custom-v-pills-payment-tab">
                                        <div>
                                            <h4 class="header-title">{{__('user.payment_method')}}</h4>


                                            @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_RAZORPAY))
                                                <div class="border p-3 mb-3 mt-3 rounded">
                                                    <div class="float-right">
                                                        <i class="far fa-credit-card font-24 text-primary"></i>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="razorpayPaymentRadio"
                                                               name="billingOptions"
                                                               class="custom-control-input">
                                                        <label class="custom-control-label font-16 font-weight-bold"
                                                               for="razorpayPaymentRadio">{{__('user.pay_with')}}
                                                            Razorpay</label>
                                                    </div>
                                                </div>
                                            @endif

                                            @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_PAYSTACK))
                                                <div class="border p-3 mb-3 mt-3 rounded">
                                                    <div class="float-right">
                                                        <i class="far fa-credit-card font-24 text-primary"></i>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="paystackPaymentRadio"
                                                               name="billingOptions"
                                                               class="custom-control-input">
                                                        <label class="custom-control-label font-16 font-weight-bold"
                                                               for="paystackPaymentRadio">{{__('user.pay_with')}}
                                                            Paystack</label>
                                                    </div>
                                                </div>
                                            @endif

                                            @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_STRIPE))
                                                <div class="border p-3 mb-3 mt-3 rounded">
                                                    <div class="float-right">
                                                        <i class="far fa-credit-card font-24 text-primary"></i>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="stripePaymentRadio"
                                                               name="billingOptions"
                                                               class="custom-control-input">
                                                        <label class="custom-control-label font-16 font-weight-bold"
                                                               for="stripePaymentRadio">{{__('user.pay_with')}}
                                                            Stripe</label>
                                                    </div>
                                                </div>
                                            @endif

                                        <!-- Cash on Delivery box-->

                                            @if(\App\Models\AppData::paymentMethodEnabled($appData->support_payments,\App\Models\Order::$ORDER_PT_COD))
                                                <div class="border p-3 mb-3 rounded">
                                                    <div class="float-right">
                                                        <i class="fas fa-money-bill-alt font-24 text-primary"></i>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="CODPaymentRadio" name="billingOptions"
                                                               class="custom-control-input" checked>
                                                        <label class="custom-control-label font-16 font-weight-bold"
                                                               for="CODPaymentRadio">{{__('user.cash_on_delivery')}}</label>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="{{route('user.carts.index')}}"
                                           class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left"></i> {{__('user.back_to_shopping_cart')}} </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-right mt-2 mt-sm-0">
                                            <button id="placeOrderBtn"
                                                    class="btn btn-success">
                                                <i class="mdi mdi-shopping-outline mr-1"></i> {{__('user.place_order')}}
                                            </button>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="col-lg-4 mt-3">

                                <div class="form-group mb-3">
                                    <label for="couponSelect">{{__('user.coupon')}}</label>
                                    <select class="form-control" id="couponSelect">
                                        <option value="-1" selected>{{__('user.no_coupon')}}</option>

                                    </select>
                                </div>


                                <div class="border mt-2 rounded">
                                    <h4 class="header-title p-2 mb-0">{{__('user.order_summary')}}</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap mb-0">
                                            <tbody>
                                            @foreach($carts as $cart)
                                                <tr>

                                                    <td>
                                                        @if(count($cart->product['productImages'])!=0)
                                                            <img
                                                                src="{{asset('storage/'.$cart->product['productImages'][0]['url'])}}"
                                                                style="object-fit: cover" alt="OOps"
                                                                height="48px"
                                                                width="48px"
                                                                class="img-fluid"
                                                            >
                                                        @else
                                                            <img
                                                                src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                                style="object-fit: cover" alt="OOps" height="48"
                                                                class="img-fluid">
                                                        @endif
                                                        <div
                                                            class="m-0 ml-3 d-inline-block align-middle font-16">
                                                            <a href=""
                                                               class="text-body font-weight-semibold">{{$cart->product->name}}</a>
                                                            <br>
                                                            {{\App\Helpers\ProductUtil::getProductItemFeatures($cart->productItem)}}
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        {{\App\Helpers\CurrencyUtil::getCurrencySign(true)}}{{\App\Helpers\CurrencyUtil::getDiscountedPrice($cart->productItem->price,$cart->product->offer,true)}}
                                                        <small
                                                            class="d-block">{{$cart->quantity}} {{__('user.quantity')}}</small>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr class="text-right">
                                                <td colspan="1" class="font-weight-bolder">
                                                    {{__('user.sub_total')}}
                                                </td>
                                                <td class="text-right">
                                                    {{\App\Helpers\AppSetting::$currencySign}}<span
                                                        id="order-text"></span>
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="1" class="font-weight-bolder">
                                                    {{__('user.coupon_discount')}}
                                                </td>
                                                <td class="text-right">
                                                    - {{\App\Helpers\AppSetting::$currencySign}}<span
                                                        id="coupon-discount-text"></span>
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="1" class="font-weight-bolder">
                                                    {{__('user.tax')}}
                                                </td>
                                                <td class="text-right">
                                                    {{\App\Helpers\AppSetting::$currencySign}}<span
                                                        id="tax-text"></span>
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="1" class="font-weight-bolder">
                                                    {{__('user.delivery_fee')}}
                                                </td>
                                                <td class="text-right">
                                                    {{\App\Helpers\AppSetting::$currencySign}}<span
                                                        id="delivery-fee-text"></span>
                                                </td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="1" class="font-weight-bolder text-dark">
                                                    {{__('user.total')}}
                                                </td>
                                                <td class="text-right text-dark font-weight-bold">
                                                    {{\App\Helpers\AppSetting::$currencySign}}<span
                                                        id="total-text"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div> <!-- end .border-->
                            </div> <!-- end col-->
                            <!-- end col-->
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
        </div>


    </div> <!-- container -->

@endsection

@section('script')


    <script>

        const carts = JSON.parse("{{ json_encode($carts) }}".replace(/&quot;/g, '"'));
        const shop = carts[0].product.shop;
        const userAddresses = JSON.parse("{{ json_encode($userAddresses) }}".replace(/&quot;/g, '"'));
        const coupons = JSON.parse("{{ json_encode($coupons) }}".replace(/&quot;/g, '"'));

        let order, couponDiscount, tax, deliveryFee, total;
        let selectedAddressIndex = -1;


        //User Handler
        const pickUpOrderRadio = document.getElementById('pickUpOrderRadio');
        const homeDeliveryRadio = document.getElementById('homeDeliveryRadio');
        const addressSection = document.getElementById('address-section');
        const razorpayPaymentRadio = document.getElementById('razorpayPaymentRadio');
        const paystackPaymentRadio = document.getElementById('paystackPaymentRadio');
        const stripePaymentRadio = document.getElementById('stripePaymentRadio');
        const CODPaymentRadio = document.getElementById('CODPaymentRadio');
        const couponSelect = document.getElementById('couponSelect');

        //TextField
        const orderText = document.getElementById('order-text');
        const deliveryFeeText = document.getElementById('delivery-fee-text');
        const taxText = document.getElementById('tax-text');
        const couponDiscountText = document.getElementById('coupon-discount-text');
        const totalText = document.getElementById('total-text');
        const placeOrderBtn = document.getElementById('placeOrderBtn');


        //Listener
        pickUpOrderRadio.addEventListener('click', function () {
            addressSection.classList.add('d-none');
            changeOrderSummery();
        });
        homeDeliveryRadio.addEventListener('click', function () {
            addressSection.classList.remove('d-none');
            changeOrderSummery();
        });
        couponSelect.addEventListener('change', function () {
            changeOrderSummery();
        });
        for (let i = 0; i < userAddresses.length; i++) {
            document.getElementById('address-radio-' + i).addEventListener('click', function () {
                selectedAddressIndex = i;
                changeOrderSummery();
            });
        }


        function changeOrderSummery() {
            let orderSum = 0;
            carts.forEach(function (cart) {
                orderSum += getDiscountedPrice(cart.product_item.price, cart.product.offer) * cart.quantity;
            });

            order = orderSum;

            if (couponSelect.value != -1) {
                couponDiscount = getCouponDiscount(orderSum, coupons[couponSelect.value]);
            } else {
                couponDiscount = 0;
            }

            tax = order * carts[0].product.shop.default_tax / 100;

            if (pickUpOrderRadio.checked) {
                deliveryFee = 0;
            } else {
                if (userAddresses.length > 0) {
                    deliveryFee = getDistanceFromLatLonInMeter(shop.latitude, shop.longitude, userAddresses[selectedAddressIndex].latitude, userAddresses[selectedAddressIndex].longitude) / 1000 * shop.delivery_cost_multiplier + shop.minimum_delivery_charge;
                } else {
                    deliveryFee = 0;
                }
            }


            total = order + tax - couponDiscount + deliveryFee;


            orderText.innerText = roundToTwo(order);
            couponDiscountText.innerText = roundToTwo(couponDiscount);
            taxText.innerText = roundToTwo(tax);
            deliveryFeeText.innerText = roundToTwo(deliveryFee);
            totalText.innerText = roundToTwo(total);

        }

        function getCouponDiscount(order, coupon) {
            const discount = order * (coupon.offer) / 100;
            return discount > coupon.max_discount ? coupon.max_discount : discount;
        }

        function roundToTwo(num) {
            return +(Math.round(num + "e+2") + "e-2");
        }


        function getDiscountedPrice(price, discount) {
            return price * (100 - discount) / 100;
        }

        function getDistanceFromLatLonInMeter(lat1, lon1, lat2, lon2) {
            var R = 6371000;
            var dLat = deg2rad(lat2 - lat1);
            var dLon = deg2rad(lon2 - lon1);
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2)
            ;
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return d;
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180)
        }

        init();


        function init() {
            changeOrderSummery();

            coupons.forEach(function (coupon, index) {
                const option = document.createElement('option');
                option.value = index;
                option.innerText = coupon.code;
                option.disabled = order < coupon.min_order;
                couponSelect.appendChild(option);
            });
        }


        placeOrderBtn.addEventListener('click', function () {
            const form = document.createElement('form');
            form.action = '{{route('user.orders.store')}}';
            form.method = 'post';

            var paymentType = 1;
            if (razorpayPaymentRadio.checked)
                paymentType = 2;
            if (paystackPaymentRadio.checked)
                paymentType = 3;
            if (stripePaymentRadio.checked)
                paymentType = 4

            form.appendChild(createInputElementHidden('_token', '{{csrf_token()}}'));
            form.appendChild(createInputElementHidden('payment_type', paymentType));
            form.appendChild(createInputElementHidden('shop_id', shop.id));
            form.appendChild(createInputElementHidden('order', order));
            form.appendChild(createInputElementHidden('tax', tax));
            form.appendChild(createInputElementHidden('delivery_fee', deliveryFee));
            form.appendChild(createInputElementHidden('total', total));
            form.appendChild(createInputElementHidden('order_type', pickUpOrderRadio.checked ? 1 : 2));
            if (userAddresses.length > 0) {
                if (selectedAddressIndex != -1) {
                    form.appendChild(createInputElementHidden('address_id', userAddresses[selectedAddressIndex].id));
                }
            }
            if (couponSelect.value != -1) {
                form.appendChild(createInputElementHidden('coupon_id', coupons[couponSelect.value].id));
                form.appendChild(createInputElementHidden('coupon_discount', couponDiscount));
            }

            document.getElementsByClassName('container-fluid')[0].append(form);
            form.submit();
            form.remove();
        });

        function createElement(tag, type, name, value) {
            const element = document.createElement(tag);
            element.type = type;
            element.name = name;
            element.value = value;
            return element;
        }

        function createElementHidden(tag, name, value) {
            return createElement(tag, 'hidden', name, value);
        }

        function createInputElementHidden(name, value) {
            return createElement('input', 'hidden', name, value);
        }


    </script>


@endsection
