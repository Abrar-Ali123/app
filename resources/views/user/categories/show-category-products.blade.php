@extends('user.layouts.app', ['title' => 'Products'])

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
                            <li class="breadcrumb-item active">{{__('user.products')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.category')}} : {{$category->title}} </h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row mt-2">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3">
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
                                    </div> <!-- end product info-->
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> <!-- end card-body-->
        <!-- end card-->

        <div class="float-right">
            {{$products->links()}}</div>
    </div> <!-- container -->

@endsection

@section('script')


@endsection
