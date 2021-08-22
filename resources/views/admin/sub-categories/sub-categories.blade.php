@extends('admin.layouts.app', ['title' => 'Sub Categories'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('admin.sub_category')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.sub_category')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">

                                    {{ $sub_categories->links() }}

                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a type="button" href="{{route('admin.sub-categories.create')}}"
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
                                    <th>{{__('admin.sub_category')}}</th>
                                    <th>{{__('admin.category')}}</th>
                                    <th>{{__('admin.description')}}</th>
                                    <th style="width: 82px;">{{__('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sub_categories as $sub_category)
                                    <tr>
                                        <td>
                                            <div>
                                                <img src="{{asset('storage/'.$sub_category->category->image_url)}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     height="40px"
                                                     width="40px">
                                            </div>
                                        </td>
                                        <td>{{$sub_category->title}}</td>
                                        <td><a href="{{route('admin.categories.edit',['id'=>$sub_category->category->id])}}">{{$sub_category->category->title}}</a>
                                        </td>
                                        <td>
                                            <div
                                                style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;  width: 350px;">@if($sub_category->description){{$sub_category->description}}@else{{$sub_category->category->description}}@endif</div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.sub-categories.edit',['id'=>$sub_category->id])}}"
                                               style="font-size: 20px"> <i
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
