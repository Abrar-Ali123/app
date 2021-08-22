<!DOCTYPE html>
<html lang="en">
<head>
    @include('manager.layouts.shared.title-meta', ['title' => "Reset Password"])

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
                            <p class="text-muted mb-4 mt-3">Enter your email address to send reset password link</p>
                        </div>

                        <form method="POST" action="{{ route('manager.password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <div>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Send Password Reset Link
                                </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
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



