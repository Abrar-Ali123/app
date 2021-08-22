<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.shared/title-meta', ['title' => "Stripe Payment Done"])
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

        <div class="text-center mt-5">Payment done..!! Please close browser and go to applications</div>


    </div> <
    <!-- content -->

    @include('user.layouts.shared/footer')
</div>


@include('user.layouts.shared/footer-script')

</body>

<script>



</script>
</html>
