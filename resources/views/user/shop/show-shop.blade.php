@extends('user.layouts.app', ['title' => $shop->name])

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
                            <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$shop->name}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$shop->name}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-4">


                            <img src="{{asset('storage/'.$shop->image_url)}}"
                                 style="object-fit: cover" alt="OOps"
                                 class="img-fluid"/>

                        </div> <!-- end col -->
                        <div class="col-lg-8">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <h4 class="mb-3">{{$shop->name}}</h4>
                                <div class="mb-3">
                                    @for($i=1;$i<6;$i++)
                                        @if($shop->rating >= $i)
                                            <i class="fa fa-star text-success"></i>
                                        @else
                                            <i class="fa fa-star text-light"></i>
                                        @endif
                                    @endfor
                                    <a href="{{route('user.shop.reviews.show',['id'=>$shop->id])}}">
                                        ({{$shop->total_rating}} {{__('user.reviews')}})</a>
                                </div>

                                {!!  $shop->description !!}

                                <div class="mt-2">
                                    <a target="_blank" href="{{\App\Helpers\TextUtil::getPhoneUrl($shop->mobile)}}" class="btn btn-primary waves-effect waves-light mt-2 mr-4">
                                        <span class="btn-label"><i class="mdi mdi-phone-forward-outline"></i></span>{{__('user.call_at_shop')}}
                                    </a>
                                    <a target="_blank" href="{{\App\Helpers\TextUtil::getGoogleMapLocationUrl($shop->latitude,$shop->longitude)}}" class="btn btn-primary waves-effect waves-light mt-2">
                                        <span class="btn-label"><i class="mdi mdi-map-marker-outline"></i></span>{{__('user.go_to_shop')}}
                                    </a>

                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

            <h4 class="page-title">{{__('user.products')}}</h4>


            <div class="row mt-4">
                @foreach($products as $product)
                    <div class="col-md-6 col-xl-3">
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
                                            <h5 class="mt-2"><span
                                                    class="text-muted"> {{count($product['productItems'])}} {{__('user.types_of_items_available')}}</span>
                                            </h5>
                                        </div>

                                    </div> <!-- end row -->
                                </div>



                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-end">

                {{$products->links()}}

            </div>

        </div> <!-- container -->

@endsection

@section('script')

@endsection
