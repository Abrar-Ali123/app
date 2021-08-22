@extends('admin.layouts.app', ['title' => 'Edit Category'])

@section('css')

@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">{{__('admin.users')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.edit_user')}}</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{route('admin.users.update',['id'=>$user->id])}}" method="post"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            {{method_field('PATCH')}}

                            <div class="form-group mb-3">
                                <label for="name">{{__('admin.name')}}</label>
                                <input type="text" id="name" name="name"
                                       class="form-control @if($errors->has('name')) is-invalid @endif"
                                       placeholder="e.g : Apple iMac" value="{{$user->name}}" readonly>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">{{__('admin.email')}}</label>
                                <input type="email" id="email" name="email"
                                       class="form-control @if($errors->has('email')) is-invalid @endif"
                                       placeholder="abc@xyz.com" value="{{$user->email}}" readonly>
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="mobile">{{__('admin.mobile')}}</label>
                                <input type="text" id="mobile" name="mobile"
                                       class="form-control @if($errors->has('mobile')) is-invalid @endif"
                                       placeholder="(xx) xxxxx xxxxx" value="{{$user->mobile}}">
                                @if($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="blocked"
                                       name="blocked" {{$user->blocked ? "checked" : ""}}>
                                <label class="custom-control-label" for="blocked">{{__('admin.block')}}</label>
                            </div>



                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('admin.update')}}</button>
                                <a type="button" href="{{route('admin.users.index')}}"
                                   class="btn btn-danger waves-effect waves-light m-l-10">{{__('admin.cancel')}}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
