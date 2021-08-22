<!DOCTYPE html>
<html lang="en">
<head>
    @include('manager.layouts.shared.title-meta', ['title' => "Log In"])

    @include('manager.layouts.shared.head-css')
</head>

<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{route('home')}}" class="logo logo-dark text-center">
                                            <span class="logo">
                                                <span class="logo-lg-text-dark"
                                                      style="letter-spacing: 1px">{{env('APP_NAME')}} - Manager</span>
                                            </span>
                                </a>
                            </div>

                            <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin
                                panel.</p>
                        </div>

                        <form action="{{route('manager.login')}}" method="POST" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control  @if($errors->has('email')) is-invalid @endif" name="email"
                                       type="email"
                                       id="emailaddress" required=""
                                       value="{{ old('email')  ?? "manager@demo.com"}}"
                                       placeholder="Enter your email"/>

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <a href="{{route('manager.password.request')}}" class="text-muted float-right"><small>Forgot
                                        your
                                        password?</small></a>
                                <label for="password">Password</label>
                                <div
                                    class="input-group input-group-merge @if($errors->has('password')) is-invalid @endif">
                                    <input class="form-control @if($errors->has('password')) is-invalid @endif"
                                           name="password" type="password" required="" value="password"
                                           id="password" placeholder="Enter your password"/>
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In</button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p><a href="{{route('manager.password.request')}}" class="text-white-50 ml-1">Forgot your
                                password?</a></p>
                        <p class="text-white-50">Don't have an account? <a href="/manager/register"
                                                                           class="text-white ml-1"><b>Sign Up</b></a>
                        </p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script> &copy; {{env('APP_NAME')}} by <a href="{{route('home')}}"
                                                                                               class="text-white-50">{{env('COMPANY_NAME')}}</a>
</footer>

@include('manager.layouts.shared.footer-script')

</body>
</html>
