<html lang="en">
<head>

    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet"/>
    <link href="{{asset('assets/css/app.min.css')}} " rel="stylesheet" type="text/css" id="app-default-stylesheet"/>
    <title>Order Receipt</title>
</head>
<body class="p-2">
<!-- Start Content-->
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="error-text-box">
                <svg viewBox="0 0 600 200">
                    <!-- Symbol-->
                    <symbol id="s-text">
                        <text text-anchor="middle" x="50%" y="50%" dy=".35em">500!</text>
                    </symbol>
                    <!-- Duplicate symbols-->
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                    <use class="text" xlink:href="#s-text"></use>
                </svg>
            </div>
            <div class="text-center">
                <h3 class="mt-0 mb-2">{{__('user.your_account_suspended_by_admin')}}</h3>
                <p class="text-muted mb-3">{{__('user.contact_admin_for_unblock')}}</p>

                <a href="{{ route('user.logout') }}" class="btn btn-primary waves-effect waves-light">{{__('user.logout')}}</a>
            </div>
            <!-- end row -->

        </div> <!-- end col -->
    </div>
</div>
</body>
</html>
