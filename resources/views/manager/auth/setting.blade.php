@extends('manager.layouts.app', ['title' => 'Setting'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.setting')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.setting')}}</h4>
                </div>
            </div>
        </div>

        <form action="{{route('manager.setting.update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            {{method_field('PATCH')}}
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title text-center">{{__('manager.avatar')}}</h5>
                            <div class="form-group ">
                                <input type="file" name="image" id="image" data-plugins="dropify"
                                       data-default-file="{{\App\Helpers\TextUtil::getImageUrl($manager->avatar_url,\App\Helpers\TextUtil::$PLACEHOLDER_AVATAR_URL)}}"/>
                                <p class="text-muted text-center mt-2 mb-0">{{__('manager.upload_image')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6  col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{__('manager.general_information')}}</h5>
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="name">{{__('manager.name')}}</label>
                                        <input type="text"
                                               class="form-control @if($errors->has('name')) is-invalid @endif"
                                               id="name" placeholder="Name" name="name" value="{{$manager->name}}" disabled>
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="email">{{__('manager.email')}}</label>
                                        <input type="email"
                                               class="form-control @if($errors->has('email')) is-invalid @endif"
                                               id="email" placeholder="Email" name="email" value="{{$manager->email}}" disabled>
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="mobile">{{__('manager.mobile')}}</label>
                                        <input type="tel"
                                               class="form-control @if($errors->has('mobile')) is-invalid @endif"
                                               id="mobile" placeholder="Mobile" name="mobile" value="{{$manager->mobile}}">
                                        @if($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="public_email">{{__('manager.public_email')}}</label>
                                        <input type="email"
                                               class="form-control @if($errors->has('public_email')) is-invalid @endif"
                                               id="public_email" placeholder="Public Email" name="public_email" value="{{$manager->public_email}}">
                                        @if($errors->has('public_email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('public_email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="address">{{__('manager.address')}}</label>
                                        <input type="text"
                                               class="form-control @if($errors->has('address')) is-invalid @endif"
                                                id="address" placeholder="Address" name="address" value="{{$manager->address}}">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="password">{{__('manager.change_password')}}</label>
                                        <input type="password"
                                               class="form-control @if($errors->has('password')) is-invalid @endif"
                                               id="password" placeholder="Password" name="password" value="" autocomplete="new-password">
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-1">{{__('manager.update')}}
                    </button>
                </div>
            </div>

        </form>


    </div> <!-- container -->
@endsection

@section('script')
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
