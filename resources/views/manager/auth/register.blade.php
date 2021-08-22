<!DOCTYPE html>
<html lang="en">
<head>
    @include('manager.layouts.shared.title-meta', ['title' => "Register"])

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
                                   <span class="logo">
                                                <span class="logo-lg-text-dark"
                                                      style="letter-spacing: 1px">{{env('APP_NAME')}} - Manager</span>
                                            </span>
                            <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less
                                than a minute</p>
                        </div>

                        <form action="{{route('manager.register')}}" method="POST" novalidate>
                            @csrf

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input class="form-control @if($errors->has('name')) is-invalid @endif" name="name"
                                       type="text"
                                       id="fullname" placeholder="Enter your name" required
                                       value="{{ old('name')}}"/>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email"
                                       type="email"
                                       id="emailaddress" required placeholder="Enter your email"
                                       value="{{ old('email')}}"/>

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @if($errors->has('password')) is-invalid @endif"
                                       name="password" type="password" required id="password"
                                       placeholder="Enter your password"/>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm password</label>
                                <input class="form-control @if($errors->has('confirm_password')) is-invalid @endif"
                                       name="confirm_password" type="password" required id="confirm_password"
                                       placeholder="Enter your password"/>

                                @if($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                    <label class="custom-control-label" for="checkbox-signup">I accept <a
                                            href="javascript: void(0);" class="text-dark">Terms and
                                            Conditions</a></label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Sign Up</button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have account? <a href="{{route('manager.login')}}"
                                                                          class="text-white ml-1"><b>Sign In</b></a></p>
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
    <script>document.write(new Date().getFullYear())</script> &copy; {{env('APP_NAME')}} by <a href=""
                                                                                               class="text-white-50">{{env('COMPANY_NAME')}}</a>
</footer>

@include('layouts.shared.footer-script')

</body>
</html>
