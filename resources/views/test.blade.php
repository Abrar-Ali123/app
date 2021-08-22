<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Home | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="{{env('COMPANY_NAME')}}" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-------Styles--------->

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet"/>
    <link href="{{asset('assets/css/app.min.css')}} " rel="stylesheet" type="text/css" id="app-default-stylesheet"/>
    <link href="{{asset('assets/css/bootstrap-dark.min.css')}} " rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet" disabled/>
    <link href="{{asset('assets/css/app-dark.min.css')}} " rel="stylesheet" type="text/css" id="app-dark-stylesheet"
          disabled/>


</head>

<body class="authentication-bg authentication-bg-pattern">

{{--<form method="POST" action="{{ route('test') }}" accept-charset="UTF-8" class="form-horizontal" role="form">--}}
{{--    <div class="row" style="margin-bottom:40px;">--}}
{{--        <div class="col-md-8 col-md-offset-2">--}}
{{--            <p>--}}
{{--            <div>--}}
{{--                Lagos Eyo Print Tee Shirt--}}
{{--                ₦ 2,950--}}
{{--            </div>--}}
{{--            </p>--}}
{{--            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> --}}{{-- required --}}
{{--            <input type="hidden" name="orderID" value="345">--}}
{{--            <input type="hidden" name="amount" value="2400"> --}}{{-- required in kobo --}}
{{--            <input type="hidden" name="quantity" value="1">--}}
{{--            <input type="hidden" name="currency" value="ZAR">--}}
{{--            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > --}}{{-- For other necessary things you want to add to your payload. it is optional though --}}
{{--            <input type="hidden" name="accesscode" value="{{ Unicodeveloper\Paystack\Facades\Paystack::genTranxRef() }}"> --}}{{-- required --}}
{{--            {{ csrf_field() }} --}}{{-- works only when using laravel 5.1, 5.2 --}}

{{--            <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}{{-- employ this in place of csrf_field only in laravel 5.0 --}}

{{--            <p>--}}
{{--                <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">--}}
{{--                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!--}}
{{--                </button>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}

<form action="{{route('test')}}" method="POST">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="{{\App\Helpers\AppSetting::$STRIPE_PUBLIC_KEY}}"
        data-name="Custom t-shirt"
        data-description="Your custom designed t-shirt"
        data-amount="1200"
        data-currency="USD"
{{--        data-zip-code="required"--}}
{{--        data-billing-address="required"--}}

    >
    </script>
</form>
</body>
</html>


