{{-- EMall V2.0.0--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Home | {{env('APP_NAME')}} v2.0.0</title>
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

    <style>
        @media (min-width: 1024px) {
            .account-pages{
                position: absolute;top: 50%;left: 50%;
                transform: translate(-50%, -50%);
            }
        }
    </style>

</head>

<body class="authentication-bg authentication-bg-pattern">
    <div class="account-pages container">
        <div class="row align-items-center mt-5">

            <div class="col-md-6 col-lg-3 col-sm-12">
                <a target="_blank" href="{{route('admin.login')}}">
                    <div class="card bg-pattern">
                        <div class="card-title text-center mt-3">
                            <h3 class="title">Admin</h3>
                        </div>
                        <div class="card-body">
                            <i class=" dripicons-user avatar-title text-primary" style="font-size: 150px"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12">
                <a target="_blank"  href="{{route('manager.login')}}">
                    <div class="card bg-pattern">
                        <div class="card-title text-center mt-3">
                            <h3 class="title">Manager</h3>
                        </div>
                        <div class="card-body">
                            <i class=" dripicons-user-group avatar-title text-primary" style="font-size: 150px"></i>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-6 col-lg-3 col-sm-12">
                <a target="_blank"  href="{{route('user.login')}}">
                    <div class="card bg-pattern">
                        <div class="card-title text-center mt-3">
                            <h3 class="title">User</h3>
                        </div>
                        <div class="card-body">
                            <i class=" dripicons-user-group avatar-title text-primary" style="font-size: 150px"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-sm-12">
                <div class="card bg-pattern">
                    <div class="card-title text-center mt-3">
                        <h3 class="title">APKs</h3>
                    </div>
                    <div class="card-body text-center">
                        <a href="{{route('downloads.apk')}}" target="_blank">
                        <img src=
                             "https://chart.googleapis.com/chart?cht=qr&chl={{route('downloads.apk')}}&chs=160x160&chld=L|0"
                             class="qr-code img-thumbnail img-responsive"  width="150px"/>

                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer footer-alt">
        <script>document.write(new Date().getFullYear().toString())</script> &COPY; {{env('APP_NAME')}} by <a href="{{route('home')}}" class="text-white-50">{{env('COMPANY_NAME')}}</a>
    </footer>

    @include('layouts.shared.footer-script')


<!-- Footer Start -->

<!-- end Footer -->

<script src="{{asset('assets/js/vendor.min.js')}}"></script>

<script src="{{asset('assets/js/app.min.js')}}"></script>


</body>
</html>


