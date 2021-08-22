@extends('manager.layouts.app', ['title' => 'My Shop'])

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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('manager.my_shop')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.my_shop')}}</h4>
                </div>
            </div>
        </div>


        @if($have_shop)
            <div class="col-lg-6 col-xl-4">
                <!-- Simple card -->
                <div class="card">
                    <img class="card-img-top" style="object-fit: cover" src="{{asset('/storage/'.$shop->image_url)}}"
                         alt="Card image cap" height="200" width="100">
                    <div class="card-body">
                        <h5 class="card-title">{{$shop->name}}</h5>
                        <div class="row">
                            <div class="col-1">
                                <i class="far fa-envelope mr-1"></i>
                            </div>
                            <div class="col">
                                <span> {{$shop->email}}</span>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="text-right">
                                    <a target="_blank" class="btn btn-outline-primary waves-effect waves-light"
                                       href="{{\App\Models\Shop::generateGoogleMapLocationUrl($shop->latitude,$shop->longitude)}}">
                                        <i class="mdi mdi-map-marker-outline mr-1"></i> {{__('manager.location')}}
                                    </a>

                                    <a class="btn btn-outline-primary waves-effect waves-light ml-2"
                                       href="{{route('manager.shops.show_reviews',['id'=> $shop->id])}}">
                                        <i class="mdi mdi-star-outline mr-1"></i> {{__('manager.review')}}
                                    </a>

                                    <a class="btn btn-primary waves-effect waves-light ml-2"
                                       href="{{route('manager.shops.edit',['id'=>$shop->id])}}">
                                        <i class="mdi mdi-pencil-outline mr-1"></i> {{__('manager.edit')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

        @elseif($have_shop_request)
            <div class="col-lg-6 col-xl-4">
                <!-- Simple card -->
                <div class="card">
                    <img class="card-img-top" style="object-fit: cover" height="200"
                         src="{{asset('/storage/'.$shop->image_url)}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$shop->name}}</h5>

                        <form action="{{route('manager.shop_requests.destroy',['id'=>$shop_request->id])}}"
                              method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="hidden" name="manager_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="shop_id" value="{{$shop->id}}">
                            <p class="card-text">
                                <small class="text-muted">{{__('manager.you_already_request_this')}}</small>
                            </p>
                            <button type="submit"
                                    class="btn btn-danger waves-effect waves-light">{{__('manager.cancel_request')}}
                            </button>
                            <a target="_blank" class="btn btn-outline-primary waves-effect waves-light ml-1"
                               href="{{\App\Models\Shop::generateGoogleMapLocationUrl($shop->latitude,$shop->longitude)}}">
                                <i class="mdi mdi-map-marker-outline mr-1"></i> {{__('manager.location')}}
                            </a>

                        </form>
                    </div>
                </div>
            </div><!-- end col -->
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3>{{__('manager.you_have_not_shop_yet')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 row m-1">
                    @foreach($shops as $shop)
                        <div class="col-lg-6 col-xl-4">
                            <!-- Simple card -->
                            <div class="card">
                                <img class="card-img-top" style="object-fit: cover"
                                     src="{{asset('/storage/'.$shop->image_url)}}"
                                     alt="Card image cap" height="250" width="100">
                                <div class="card-body">
                                    <h5 class="card-title">{{$shop->name}}</h5>

                                    <form action="{{route('manager.shop_requests.store')}}" method="post"
                                          class="d-inline">
                                        @csrf
                                        <input type="hidden" name="manager_id" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                        <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">{{__('manager.join')}}
                                        </button>
                                    </form>
                                    <a target="_blank" class="btn btn-outline-primary waves-effect waves-light ml-2"
                                       href="{{\App\Models\Shop::generateGoogleMapLocationUrl($shop->latitude,$shop->longitude)}}">
                                        <i class="mdi mdi-map-marker-outline mr-1"></i> {{__('manager.location')}}
                                    </a>
                                </div>
                            </div>
                        </div><!-- end col -->
                    @endforeach
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        @endif
    </div> <!-- container -->

@endsection

@section('script')

@endsection
