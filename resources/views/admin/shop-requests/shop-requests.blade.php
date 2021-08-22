@extends('admin.layouts.app', ['title' => 'Shop Request'])

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
                            <li class="breadcrumb-item active">{{__('admin.shop_revenue')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.shop_request')}}</h4>
                </div>
            </div>
        </div>


        @if($have_shop_request)
            <div class="row">
                @foreach($shop_requests as $shop_request)
                    <div class="col-xl-6">
                        <div class="card-box">
                            <form
                                action="{{route('admin.shop_requests.update',['id'=>$shop_request['id']])}}"
                                method="post">
                                @csrf
                                {{method_field('PATCH')}}
                                <input type="hidden" name="id"
                                       value="{{$shop_request['id']}}">
                                <input type="hidden" name="manager_id"
                                       value="{{$shop_request['manager']->id}}">
                                <input type="hidden" name="shop_id"
                                       value="{{$shop_request['shop']->id}}">
                                <h4 class="header-title mb-4">Request #{{$shop_request['id']}}</h4>
                                <ul class="nav nav-pills navtab-bg nav-justified">
                                    <li class="nav-item">
                                        <a href="#shop-{{$shop_request['id']}}" data-toggle="tab" aria-expanded="false"
                                           class="nav-link active">
                                            {{__('admin.shop')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#manager-{{$shop_request['id']}}" data-toggle="tab"
                                           aria-expanded="true"
                                           class="nav-link">
                                            {{__('admin.manager')}}
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="shop-{{$shop_request['id']}}">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-6">
                                                <img class="card-img-top" style="object-fit: cover" height="200"
                                                     src="{{asset('/storage/'.$shop_request['shop']->image_url)}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <h4 class="card-title mt-2">
                                                    {{$shop_request['shop']->name}}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-1">
                                                        <i class="far fa-envelope mr-1"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['shop']->email}}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2 row">
                                                    <div class="col-1">
                                                        <i class="far fa-map mr-1"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['shop']->address}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="manager-{{$shop_request['id']}}">
                                        <div class="row justify-content-center">
                                            <div class="col-6 col-md-4 text-center">
                                                <img class="card-img-top img-fluid rounded-circle img-thumbnail"
                                                     style="object-fit: cover" height="200"
                                                     src="{{asset('/storage/'.$shop_request['manager']->avatar_url)}}"
                                                     alt="Card image cap">
                                            </div>
                                            <div class="col-8 col-md-8 mt-3">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <i class="far fa-user mr-1"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['manager']->name}}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-2 row">
                                                    <div class="col-1">
                                                        <i class="far fa-envelope mr-1"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['manager']->email}}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-2 row">
                                                    <div class="col-1">
                                                        <i class=" far fa-map mr-1"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['manager']->address}}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-2 row">
                                                    <div class="col-1">
                                                        <i class="far fa-address-book"></i>
                                                    </div>
                                                    <div class="col">
                                                        <span> {{$shop_request['manager']->mobile}}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="text-right">
                                        <button type="submit" name="action" value="accept"
                                                class="btn btn-primary waves-effect waves-light mr-2">{{__('admin.accept')}}
                                        </button>
                                        <button type="submit" name="action" value="decline"
                                                class="btn btn-danger waves-effect waves-light">{{__('admin.decline')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-box-->
                    </div>
                @endforeach

            </div>
        @else
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3>{{__('admin.there_is_no_shop_request')}}</h3>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            </div>
        @endif
    </div>

@endsection

@section('script')

@endsection
