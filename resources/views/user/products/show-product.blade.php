@extends('user.layouts.app', ['title' => $product->name])

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
                            <li class="breadcrumb-item active">{{$product->name}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$product->name}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-4">


                            @if(count($product['productImages'])==0)
                                <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                     style="object-fit: cover" alt="OOps"
                                     class="img-fluid">
                            @elseif(count($product['productImages'])==1)
                                <img src="{{asset('storage/'.$product->productImages[0]->url)}}"
                                     style="object-fit: cover" alt="OOps"
                                     class="img-fluid"/>
                            @else
                            <div id="productImageIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($product->productImages as $productImage)
                                        <li data-target="#productImageIndicators" data-slide-to="{{$loop->index}}" class="@if($loop->index===0) active @endif"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($product->productImages as $productImage)
                                        <div class="carousel-item @if($loop->index===0) active @endif">
                                                <img src="{{asset('storage/'.$productImage->url)}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     class="img-fluid"/>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#productImageIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#productImageIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            @endif

                        </div> <!-- end col -->
                        <div class="col-lg-8">
                            <div class="pl-xl-3 mt-3 mt-xl-0">
                                <a href="{{route('user.categories.show',["id"=>$product->category_id])}}" class="text-primary">{{$product['category']['title']}}
                                    -</a><a href="{{route('user.sub-categories.show',["id"=>$product->sub_category_id])}}"> {{$product['subCategory']['title']}}</a>
                                <h4 class="mb-3">{{$product->name}}</h4>
                                <div class="">
                                    @for($i=1;$i<6;$i++)
                                        @if($product->rating >= $i)
                                            <i class="fa fa-star text-success"></i>
                                        @else
                                            <i class="fa fa-star text-light"></i>
                                        @endif
                                    @endfor

                                    <a class="ml-1 font-weight-semibold" href="{{route('user.product.reviews.show',['id'=>$product->id])}}"> @if($product->rating>0) <span>{{$product->rating}} / 5 {{__('user.rating')}} & </span> @endif {{$product->total_rating}} {{__('user.reviews')}}</a>
                                </div>
                                @if($product->offer>0)
                                    <h6 class="text-danger text-uppercase">{{$product->offer}} % Off</h6>
                                    <h4>Price : <span class="text-muted mr-2"><del>{{\App\Helpers\AppSetting::$currencySign}}<span id="price-text"></span> </del></span>
                                        <b>{{\App\Helpers\AppSetting::$currencySign}}<span id="discounted-price-text"></span></b></h4>
                                @else
                                    <h4>Price : <span class="mr-2">{{\App\Helpers\AppSetting::$currencySign}}<span id="price-text"></span></span>
                                    </h4>
                                @endif

                                <h5 class="mt-3"><span id="quantity-text"></span> {{__('user.items_available')}}</h5>

                                {!!  $product->description !!}

                                <form action="{{route('user.carts.store')}}" method="post" class="form mb-3 mt-3">
                                    @csrf
                                    <label class="my-1 mr-2" for="quantityinput">Products</label>
                                    <div class="mt-2">
                                    @foreach($product->productItems as $productItem)
                                        <div class="radio  radio-primary  mb-2 d-flex">
                                            <input type="radio" name="product_item_id" id="product-item-radio-{{$productItem->id}}"
                                                   class="mt-2 align-self-center"
                                                   value="{{$productItem->id}}">
                                            <label for="product-item-radio-{{$productItem->id}}">
                                                <div class="mt-n1 mb-1">
                                                    {{\App\Helpers\ProductUtil::getProductItemFeatures($productItem)}}</div>
                                            </label>
                                        </div>
                                    @endforeach
                                    </div>

                                    <div>
                                        <button id="favoriteBtn" type="button" class="btn btn-outline-primary mr-2"><i
                                                class="mdi mdi-18px @if($product->is_favorite) mdi-heart @else mdi-heart-outline @endif "></i></button>


                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-cart"></i></span>Add to cart
                                        </button>
                                    </div>

                                </form>


                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->


                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>


    </div> <!-- container -->

@endsection

@section('script')

    <script>



        const product = JSON.parse('{{$product}}'.replace(/&quot;/g, '"'));

        radioClicked(product['product_items'][0]);

        for(let i=0;i< product['product_items'].length;i++){
            if(i===0){
                document.getElementById('product-item-radio-'+product['product_items'][i]['id']).checked = true;
            }
            document.getElementById('product-item-radio-'+product['product_items'][i]['id']).addEventListener('click',function (){
                radioClicked(product['product_items'][i]);
            });
        }

        function radioClicked(productItem){
            const discountPrice = document.getElementById('discounted-price-text');
            const price = document.getElementById('price-text');
            const quantity = document.getElementById('quantity-text');
            if(parseInt(product['offer'])>0) {
                discountPrice.innerText = (productItem['price'] * ((100 - parseInt(product['offer']))/100)).toString();
            }
            price.innerText = productItem['price'].toString();
            quantity.innerText = productItem['quantity'].toString();
        }


        document.getElementById('favoriteBtn').addEventListener('click',function (){
            const form = document.createElement('form');
            form.action = '{{route('user.favorites.store')}}';
            form.method = 'post';

            form.appendChild(createInputElementHidden('_token','{{csrf_token()}}'));
            form.appendChild(createInputElementHidden('product_id',product.id));

            document.getElementsByClassName('container-fluid')[0].append(form);
            form.submit();
            form.remove();
        });

        function createElement(tag,type,name,value){
            const element = document.createElement(tag);
            element.type = type;
            element.name = name;
            element.value = value;
            return  element;
        }

        function createElementHidden(tag,name,value){
            return createElement(tag,'hidden',name,value);
        }
        function createInputElementHidden(name,value){
            return createElement('input','hidden',name,value);
        }



    </script>
@endsection
