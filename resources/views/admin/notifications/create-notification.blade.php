@extends('admin.layouts.app', ['title' => 'Notifications'])

@section('css')

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
                            <li class="breadcrumb-item">{{__('admin.create_notification')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.create_notification')}}</h4>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.notifications.send')}}" method="post">
                            @csrf
                            <div class="form-group mt-0">
                                <label for="title">{{__('admin.notification_title')}}</label>
                                <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="{{__('admin.title')}}" name="title" value="{{old('title')}}">
                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="body">{{__('admin.notification_body')}}</label>
                                <textarea name="body" id="body" class="form-control @if($errors->has('body')) is-invalid @endif"
                                          placeholder="{{__('admin.body')}}">{{old('body')}}</textarea>
                                @if($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('admin.send_notification')}}</button>
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
