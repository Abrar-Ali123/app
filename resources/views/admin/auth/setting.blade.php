@extends('admin.layouts.app', ['title' => 'Setting'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.setting')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.setting')}}</h4>
                </div>
            </div>
        </div>

        <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            {{method_field('PATCH')}}
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title text-center">{{__('admin.avatar')}}</h5>
                            <div class="form-group ">
                                <input type="file" name="image" id="image" data-plugins="dropify"
                                       data-default-file="{{asset('/storage/'.$admin->avatar_url)}}"/>
                                <p class="text-muted text-center mt-2 mb-0">{{__('admin.upload_image')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6  col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{__('admin.general_information')}}</h5>
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="name">{{__('admin.name')}}</label>
                                        <input type="text"
                                               class="form-control @if($errors->has('name')) is-invalid @endif"
                                               id="name" placeholder="{{__('admin.name')}}" name="name" value="{{$admin->name}}">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="email">{{__('admin.email')}}</label>
                                        <input type="email"
                                               class="form-control @if($errors->has('email')) is-invalid @endif"
                                               id="email" placeholder="{{__('admin.email')}}" name="email" value="{{$admin->email}}" disabled>
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group mt-0">
                                        <label for="password">{{__('admin.change_password')}}</label>
                                        <input type="password"
                                               class="form-control @if($errors->has('password')) is-invalid @endif"
                                               id="password" placeholder="{{__('admin.change_password')}}" name="password" value="" autocomplete="new-password">
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
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-1">{{__('admin.update')}}
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
