@extends('user.layouts.app', ['title' => 'Cart'])

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
                            <li class="breadcrumb-item active">{{__('user.carts')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.shopping_cart')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">

                @if(count($filterCarts)>0)
                    <div class="row">
                        @foreach($filterCarts as $filterCart)
                            <div class="col-lg-12 mt-2 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>From {{$filterCart[0]->product->shop->name}}</h4>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-borderless table-centered mb-0">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th style="width: 50px;">Remove</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($filterCart as $cart)
                                                    <form action="{{route('user.carts.update',['id'=>$cart->id])}}"
                                                          method="post" id="form-{{$cart->id}}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <tr>
                                                            <td>
                                                                @if(count($cart->product['productImages'])!=0)
                                                                    <img
                                                                        src="{{asset('storage/'.$cart->product['productImages'][0]['url'])}}"
                                                                        style="object-fit: cover" alt="OOps"
                                                                        height="48px"
                                                                        width="48px"
                                                                        class="img-fluid"
                                                                    >
                                                                @else
                                                                    <img
                                                                        src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                                        style="object-fit: cover" alt="OOps" height="48"
                                                                        class="img-fluid">
                                                                @endif
                                                                <div
                                                                    class="m-0 ml-3 d-inline-block align-middle font-16">
                                                                    <a href=""
                                                                       class="text-reset font-family-secondary">{{$cart->product->name}}</a>
                                                                    <br>
                                                                    {{\App\Helpers\ProductUtil::getProductItemFeatures($cart->productItem)}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{\App\Helpers\CurrencyUtil::getCurrencySign(true)}}{{\App\Helpers\CurrencyUtil::getDiscountedPrice($cart->productItem->price,$cart->product->offer,true)}}
                                                            </td>
                                                            <td>

                                                                <input type="number" min="1" value="{{$cart->quantity}}"
                                                                       class="form-control" name="quantity"
                                                                       placeholder="{{__('user.quantity')}}"
                                                                       id="quantity-input-{{$cart->id}}"
                                                                       style="width: 90px;">
                                                            </td>
                                                            <td>

                                                                <a class="action-icon" id="cart-delete-{{$cart->id}}" style="cursor:pointer;">
                                                                    <i
                                                                        class="mdi mdi-delete"></i></a>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                        <div class="row mt-4">
                                            <!-- end col -->
                                            <div class="col-12">
                                                <div class="text-sm-right">
                                                    <form action="{{route('user.checkout.index')}}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="shop_id" value="{{$filterCart[0]->product->shop->id}}">
                                                    <button
                                                       class="btn btn-primary"><i class="mdi mdi-cart-plus mr-1"></i>
                                                        Checkout </button></form>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end row-->
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center">
                    <img src="{{asset('assets/images/empty-cart.png')}}" class="w-25"/>
                    <div class="text-center h3 mt-5">{{__('user.your_cart_is_empty')}}</div></div>
            @endif
            <!-- end row -->
            </div> <!-- end card-body-->
        </div>
        <div class="col-sm-6">
            <a href="{{route('user.products.index')}}"
               class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                <i class="mdi mdi-arrow-left"></i> {{__('user.continue_shopping')}}</a>
        </div><!-- end card-->


    </div> <!-- container -->

@endsection

@section('script')

    <script>

        const filterCarts = JSON.parse("{{ json_encode($filterCarts) }}".replace(/&quot;/g, '"'));
        filterCarts.forEach(function (filterCart) {
            filterCart.forEach(function (cart) {
                document.getElementById('quantity-input-' + cart.id).addEventListener('change', function (e) {
                    document.getElementById('form-' + cart.id).submit();
                });
                document.getElementById('cart-delete-' + cart.id).addEventListener('click', function (e) {
                    const form = document.createElement('form');
                    form.action = '{{route('user.carts.delete')}}';
                    form.method = 'post';
                    const inputCartId = document.createElement('input');
                    inputCartId.type = "hidden";
                    inputCartId.name = "cart_id";
                    inputCartId.value = cart.id;

                    const inputMethod = document.createElement('input');
                    inputMethod.type = "hidden";
                    inputMethod.name = "_method";
                    inputMethod.value = "DELETE";

                    const inputToken = document.createElement('input');
                    inputToken.type = "hidden";
                    inputToken.name = "_token";
                    inputToken.value = "{{csrf_token()}}";


                    form.appendChild(inputCartId);
                    form.appendChild(inputMethod);
                    form.appendChild(inputToken);
                    document.getElementsByClassName('container-fluid')[0].append(form);
                    form.submit();
                    form.remove();
                });
            })
        });


    </script>



@endsection
