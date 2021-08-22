@extends('admin.layouts.app', ['title' => 'Categories'])

@section('css')
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.category')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.category')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">

                                    {{ $categories->links() }}

                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a type="button" href="{{route('admin.categories.create')}}"
                                       class="btn btn-primary waves-effect waves-light mb-2 text-white">{{__('admin.add_category')}}
                                    </a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('admin.image')}}</th>
                                    <th>{{__('admin.category')}}</th>
                                    <th>{{__('admin.description')}}</th>
                                    <th style="width: 82px;">{{__('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <div>
                                                <img src="{{asset('storage/'.$category->image_url)}}" style="object-fit: cover" alt="OOps"
                                                     height="40px"
                                                     width="40px">
                                            </div>
                                        </td>
                                        <td>{{$category->title}}</td>

                                        <td><div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;  width: 350px;">{{$category->description}}</div></td>
                                        <td>
                                            <a href="{{route('admin.categories.edit',['id'=>$category->id])}}" style="font-size: 20px"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
