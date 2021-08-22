@extends('admin.layouts.app', ['title' => 'New Sub Category'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.sub-categories.index')}}">{{__('admin.sub_category')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.create')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.create_sub_category')}}</h4>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.sub-categories.store')}}" method="post">
                            @csrf
                            <div class="form-group mt-0">
                                <label for="title">{{__('admin.sub_category')}}</label>
                                <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="Title" name="title" value="{{old('title')}}">
                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">{{__('admin.description')}}</label>
                                <textarea name="description" id="description" class="form-control @if($errors->has('description')) is-invalid @endif"
                                          placeholder="Description">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group mb-3">
                                <label for="category">{{__('manager.category')}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="category" id="category">
                                    <option disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('admin.create')}}</button>
                                <a type="button" href="{{route('admin.sub-categories.index')}}"
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
