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

                            <p class="text-muted mb-4 mt-3">First you need to verify your mobile number</p>
                        </div>


                        <div class="form-group mb-3">
                            <label for="mobile">Mobile Number</label>
                            <input class="form-control  @if($errors->has('mobile')) is-invalid @endif" name="number"
                                   type="number"
                                   id="mobile" required=""
                                   value="{{ old('mobile')}}"
                                   placeholder="Enter your mobile"/>

                            @if($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div id="recaptcha-container"></div>


                        <div class="form-group mb-0 text-center mt-2">
                            <button class="btn btn-primary btn-block" type="button" id="btnSendOTP"> Send OTP</button>
                        </div>

                    </div> <!-- end card-body -->
                </div>



            </div> <!-- end col -->
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">

                        <div class="form-group">
                            <label for="mobile">OTP</label>
                            <input class="form-control  @if($errors->has('otp')) is-invalid @endif" name="otp"
                                   type="number"
                                   id="otp" required=""
                                   value="{{ old('otp')}}"
                                   placeholder="Enter your OTP"/>

                            @if($errors->has('otp'))
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('otp') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="button" id="btnConfirmOTP"> Confirm OTP</button>
                        </div>

                        <form action="{{route('manager.auth.mobile_verified')}}" method="POST" novalidate id="mobileNumberVerifyForm">
                            @csrf
                            <input name="mobile" hidden id="formMobileTF">
                        </form>

                    </div> <!-- end card-body -->
                </div>

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

<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>

<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>

<script>

    let captchaVerified = false;

    const mobileTF = document.getElementById('mobile');
    const otpTF = document.getElementById('otp');
    const btnSendOTP = document.getElementById('btnSendOTP');
    const btnConfirmOTP = document.getElementById('btnConfirmOTP');

    let confirmationResult;
    btnSendOTP.disabled = true;
    btnConfirmOTP.disabled = true;
    otpTF.disabled = true;

    const self = this;
    let mobileNumber;

    const recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': (response) => {
           captchaVerified = true;
           btnSendOTP.disabled = false;
        },
        'expired-callback': () => {
           captchaVerified = false;
        }
    });

    recaptchaVerifier.render().then((widgetId) => {
        console.log(widgetId);
    });

    btnSendOTP.addEventListener('click',function (e){


        var mobileNumber = mobileTF.value;
        if(mobileNumber.length===0){
            alert("please fill mobile number");
            return;
        }else{
            self.mobileNumber = mobileNumber.includes('+') ? mobileNumber : "+"+mobileNumber;
        }
        verifyNumberAndSendOTP(self.mobileNumber);
    });

    btnConfirmOTP.addEventListener('click',function (e){
        var otp = otpTF.value;
        if(otp.length!==6){
            alert("Please fill otp proper");
            return;
        }

        self.confirmationResult.confirm(otp).then((result) => {
            mobileVerifyComplete();
        }).catch((error) => {
            alert(error);
        });
    })

    function verifyNumberAndSendOTP(number){
            $.ajax({
                /* the route pointing to the post function */
                url: '{{route('manager.auth.verify_mobile_number')}}',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: '{{csrf_token()}}', mobile:number},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    sendOTP(number);
                },
                error: function(error){
                   alert("This number is already connect with another account");
                }
            });
    }

    function sendOTP(mobileNumber){
        firebase.auth().signInWithPhoneNumber(mobileNumber, recaptchaVerifier)
            .then((confirmationResult) => {
                self.mobileNumber = mobileNumber;
                self.confirmationResult = confirmationResult;
                mobileTF.disabled = true;
                otpTF.disabled = false;
                btnConfirmOTP.disabled = false;
                btnSendOTP.disabled = true;
                // ...
            }).catch((error) => {
            if(error.code==="auth/invalid-phone-number"){
                alert("Please fill correct mobile number")
            }else{
                alert("ERROR: Your Mobile Number is " + error.message)
            }
        });
    }

    function mobileVerifyComplete(){
        const mobileNumberVerifyForm = document.getElementById('mobileNumberVerifyForm');
        const formMobileTF = document.getElementById('formMobileTF');
        formMobileTF.value = self.mobileNumber;
        mobileNumberVerifyForm.submit();
    }


</script>
</html>
