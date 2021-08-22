@extends('user.layouts.app', ['title' => 'Errors'])

@section('css')

@endsection

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="error-text-box">
                    <svg viewBox="0 0 600 200">
                        <!-- Symbol-->
                        <symbol id="s-text">
                            <text text-anchor="middle" x="50%" y="50%" dy=".35em">{{$code}}!</text>
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
                    <h3 class="mt-0 mb-2">{{$error}}</h3>
                    <p class="text-muted mb-3">{{$message}}</p>

                    <a href="{{$redirect_url}}" class="btn btn-primary waves-effect waves-light">{{$redirect_text}}</a>
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->


    </div>
@endsection

@section('script')
@endsection
