
@extends('user.layouts.app', ['title' => 'Dashboard'])

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
                            <li class="breadcrumb-item active">{{__('user.home')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.home')}}</h4>
                </div>
            </div>
        </div>

        <div>

            @if(!$categories)
                <div class="row">

                    @foreach($categories as $category)
                        <div class="col-sm-2 ">
                            <img src="{{asset('storage/'.$category->image_url)}}" alt="image" class="img-fluid rounded-circle img-thumbnail bg-soft-primary p-2"  style="object-fit: cover">
                        </div>
                    @endforeach

                </div>
            @endif

            @if($shops)

                <div class="row mb-3">
                    @foreach($shops as $shop)

                        <div class="col-lg-4 col-xl-3">
                            <!-- Simple card -->
                            <a class="text-body" href="{{route('user.shops.show',['id'=>$shop->id])}}">
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
                                            <span>{{$shop->email}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach

                </div>

            @endif

            @if($trending_products)

                    <h4 class="page-title">{{__('user.trending_products')}}</h4>


                    <div class="row mt-4">
                        @foreach($trending_products as $product)
                            <div class="col-sm-6 col-lg-4 col-xl-2">
                                <a href="{{route('user.products.show',['id'=>$product->id])}}"
                                   class="text-dark">
                                    <div class="card-box product-box">

                                        <div class="bg-light">

                                            @if(count($product['productImages'])!=0)
                                                <img src="{{asset('storage/'.$product['productImages'][0]['url'])}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     class="img-fluid"
                                                >
                                            @else
                                                <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     class="img-fluid">
                                            @endif

                                        </div>

                                        <div class="product-info">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="font-16 mt-0 sp-line-1">{{$product->name}}</h5>
                                                    <div class="">
                                                        @for($i=1;$i<6;$i++)
                                                            @if($product->rating >= $i)
                                                                <i class="fa fa-star text-success"></i>
                                                            @else
                                                                <i class="fa fa-star text-light"></i>
                                                            @endif
                                                        @endfor
                                                        <span
                                                            class=""> ({{$product->total_rating}} {{__('user.reviews')}})</span>
                                                    </div>

                                                    <h6 class="mt-2"><span
                                                            class="">{{__('user.total_selling')}} : {{$product['selling_count']}} </span>
                                                    </h6>

                                                    <h6 class="mt-2"><span
                                                            class="text-muted"> {{count($product['productItems'])}} {{__('user.types_of_items_available')}}</span>
                                                    </h6>
                                                </div>

                                            </div> <!-- end row -->
                                        </div> <!-- end product info-->
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

            @if($trending_weekly_products)

                    <h4 class="page-title">{{__('user.trending_weekly_products')}}</h4>


                    <div class="row mt-4">
                        @foreach($trending_weekly_products as $product)
                            <div class="col-sm-6 col-lg-4 col-xl-2">
                                <a href="{{route('user.products.show',['id'=>$product->id])}}"
                                   class="text-dark">
                                    <div class="card-box product-box">

                                        <div class="bg-light">

                                            @if(count($product['productImages'])!=0)
                                                <img src="{{asset('storage/'.$product['productImages'][0]['url'])}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     class="img-fluid"
                                                >
                                            @else
                                                <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     class="img-fluid">
                                            @endif

                                        </div>

                                        <div class="product-info">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="font-16 mt-0 sp-line-1">{{$product->name}}</h5>
                                                    <div class="">
                                                        @for($i=1;$i<6;$i++)
                                                            @if($product->rating >= $i)
                                                                <i class="fa fa-star text-success"></i>
                                                            @else
                                                                <i class="fa fa-star text-light"></i>
                                                            @endif
                                                        @endfor
                                                        <span
                                                            class=""> ({{$product->total_rating}} {{__('user.reviews')}})</span>
                                                    </div>

                                                    <h6 class="mt-2"><span
                                                            class="">{{__('user.total_selling')}} : {{$product['selling_count']}} </span>
                                                    </h6>

                                                    <h6 class="mt-2"><span
                                                            class="text-muted"> {{count($product['productItems'])}} {{__('user.types_of_items_available')}}</span>
                                                    </h6>
                                                </div>

                                            </div> <!-- end row -->
                                        </div> <!-- end product info-->
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif


        </div>

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->

@endsection
