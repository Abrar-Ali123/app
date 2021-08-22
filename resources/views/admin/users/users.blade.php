@extends('admin.layouts.app', ['title' => 'Products'])

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
                            <li class="breadcrumb-item active">{{__('admin.users')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.users')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="float-right">
                            {{ $users->links() }}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('admin.image')}}</th>
                                    <th>{{__('admin.name')}}</th>
                                    <th>{{__('admin.email')}}</th>
                                    <th>{{__('admin.mobile')}}</th>
                                    <th>{{__('admin.verified')}}</th>
                                    <th>{{__('admin.status')}}</th>

                                    <th style="width: 82px;">{{__('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            @if($user->avatar_url)
                                                <img src="{{asset('storage/'.$user->avatar_url)}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     height="64px"
                                                     width="64px">
                                            @else
                                                <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     height="64px"
                                                     width="64px">
                                            @endif
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>
                                            @if($user->mobile_verified)
                                                <span class="text-success">{{__('admin.verified')}}</span>
                                            @else
                                                <span class="text-danger">{{__('admin.not_verified')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->blocked)
                                                <span class="text-danger">{{__('admin.blocked')}}</span>
                                            @else
                                                <span class="text-success">{{__('admin.active')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.users.edit',['id'=>$user->id])}}"
                                                style="font-size: 20px"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                        </td>
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
