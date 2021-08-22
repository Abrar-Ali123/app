@extends('user.layouts.app', ['title' => 'Order Review'])

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
                            <li class="breadcrumb-item"><a
                                    href="{{route('user.orders.index')}}">{{__('user.orders')}}</a></li>
                            <li class="breadcrumb-item active">{{__('user.review')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.review')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('user.order')}} #{{$order['id']}} </h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('user.product_name')}}</th>
                                    <th>{{__('user.products')}}</th>
                                    <th>{{__('user.quantity')}}</th>
                                    <th>{{__('user.price')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order['carts'] as $cart)
                                    <tr>
                                        <td>{{$cart['p_name']}}</td>
                                        <td>
                                            <div>
                                                @if(count($cart->product->productImages)!=0)
                                                    <img
                                                        src="{{asset('storage/'.$cart->product->productImages[0]['url'])}}"
                                                        style="object-fit: cover" alt="OOps"
                                                        height="64px"
                                                        width="64px">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                         style="object-fit: cover" alt="OOps"
                                                         height="64px"
                                                         width="64px">
                                                @endif

                                                {{\App\Helpers\ProductUtil::getProductItemFeatures($cart->productItem)}}

                                            </div>
                                        </td>
                                        <td>
                                            {{$cart['quantity']}}
                                        </td>
                                        @if($cart['p_offer']==0)
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{$cart['p_price']}}</td>
                                        @else
                                            <td>

                                                <div>
                                                    <span
                                                        style="font-size: 16px">{{\App\Helpers\AppSetting::$currencySign}} {{\App\Models\Product::getDiscountedPrice($cart['p_price'],$cart['p_offer'])}} </span>
                                                    <span
                                                        style="font-size: 12px;text-decoration: line-through;margin-left: 4px">{{\App\Helpers\AppSetting::$currencySign}} {{$cart['p_price']}}</span>
                                                </div>
                                            </td>

                                        @endif

                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.sub_total')}}</th>
                                    <td>
                                        <div
                                            class="font-weight-bold">{{\App\Helpers\AppSetting::$currencySign}} {{$order['order']}}</div>
                                    </td>
                                </tr>

                                @if($order['coupon_discount'])
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="text-right">{{__('user.coupon_discount')}}</th>
                                        <td>
                                            <div>
                                                -{{\App\Helpers\AppSetting::$currencySign}} {{$order['coupon_discount']}}</div>
                                        </td>
                                    </tr>
                                @endif


                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.delivery_fee')}}</th>
                                    <td>{{\App\Helpers\AppSetting::$currencySign}} {{round($order['delivery_fee'], 2)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.tax')}}</th>
                                    <td>{{\App\Helpers\AppSetting::$currencySign}} {{$order['tax']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="text-right">{{__('user.total')}}</th>
                                    <td>
                                        <div
                                            class="font-weight-bold">{{\App\Helpers\AppSetting::$currencySign}} {{round($order['total'], 2)}}</div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{asset('storage/'.$order->shop->image_url)}}" height="250px"
                             style="object-fit: contain"/>
                        <p class="mt-2"><span class="font-weight-bold">Shop Name : </span>{{$order->shop->name}}</p>
                        <div id="shop-review-container"></div>
                    </div>

                </div>

            </div>

            @foreach($order->carts as $cart)
                <div class="col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            @if(count($cart->product['productImages'])!=0)
                                <img
                                    src="{{asset('storage/'.$cart->product['productImages'][0]['url'])}}"
                                    height="250px" style="object-fit: contain">
                            @else
                                <img
                                    src="{{\App\Models\Product::getPlaceholderImage()}}"
                                    height="250px">
                            @endif

                            <p><span class="font-weight-bold">Product Name : </span>{{$cart->product->name}}</p>
                            <div id="product-review-container-{{$cart->id}}"></div>
                        </div>

                    </div>

                </div>
            @endforeach

            @if($order->deliveryBoy)
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <img
                                src="{{asset('storage/'.$order->deliveryBoy->avatar_url)}}"
                                height="250px" style="object-fit: contain">

                            <p class="mt-2"><span
                                    class="font-weight-bold">Delivery Boy Name : </span>{{$order->deliveryBoy->name}}
                            </p>
                            <div id="delivery-boy-review-container"></div>
                        </div>

                    </div>

                </div>
            @endif

        </div>


    </div> <!-- container -->

@endsection

@section('script')


    <script>


        class RatingView{

            rating = 5;
            container = document.createElement('div');
            stars = [];

            constructor(rating) {
                if(rating){
                    this.rating = rating;
                    for (let i = 0; i < 5; i++) {
                        const star = document.createElement('span');
                        star.classList.add('fa', 'fa-star', 'font-18');
                        if(i<this.rating){
                            star.classList.add('text-primary');
                        }
                        else{
                            star.classList.add('text-secondary');
                        }
                        this.container.appendChild(star);
                        this.stars.push(star);
                    }
                }else {
                    const self = this;
                    for (let i = 0; i < 5; i++) {
                        const star = document.createElement('span');
                        star.classList.add('fa', 'fa-star', 'text-primary', 'font-18');
                        star.style.cursor = "pointer";
                        star.addEventListener('click', function () {
                            self.rating = i + 1;
                            self.updateStar();
                        });
                        this.container.appendChild(star);
                        this.stars.push(star);
                    }
                }
            }

            updateStar(){
                for(let i=0;i<5;i++){
                    if(i<this.rating){
                        this.stars[i].classList.remove('text-secondary');
                        this.stars[i].classList.add('text-primary');
                        }
                    else{
                        this.stars[i].classList.add('text-secondary');
                        this.stars[i].classList.remove('text-primary');
                    }
                }
            }

            getView(){
                return this.container;
            }

            getRating(){
                return this.rating;
            }

        }



        const order = JSON.parse("{{ json_encode($order) }}".replace(/&quot;/g, '"'));
        console.log(order);
        const productReviewContainer = [];

        let shopRatingView,deliveryBoyRatingView;
        let productRatingViews = [];

        order.carts.forEach(function(cart){
            productReviewContainer.push(document.getElementById('product-review-container-'+cart.id.toString()));
        })

        const  shopReviewContainer = document.getElementById('shop-review-container');
        const  deliveryBoyReviewContainer = document.getElementById('delivery-boy-review-container');


        if(order.shop_review){
            const shopRatingView = new RatingView(order.shop_review.rating);
            shopReviewContainer.appendChild(shopRatingView.getView());

            const text = document.createElement('p');
            text.classList.add( 'mt-2');
            text.innerText = order.shop_review.review;
            shopReviewContainer.appendChild(text);

            const buttonElement = document.createElement('button');
            buttonElement.classList.add("btn", "btn-light" ,"waves-effect", "waves-light", "mt-2", "text-white", "mt-2");
            buttonElement.innerText = "Already reviewed";
            buttonElement.disabled = true;
            shopReviewContainer.appendChild(buttonElement);

        }else{
            const shopRatingView = new RatingView();
            shopReviewContainer.appendChild(shopRatingView.getView());

            const textArea = document.createElement('textarea');
            textArea.classList.add("form-control", 'mt-2');
            textArea.rows = 2;
            textArea.placeholder = "Review";
            shopReviewContainer.appendChild(textArea);

            const buttonElement = document.createElement('button');
            buttonElement.classList.add("btn", "btn-primary" ,"waves-effect", "waves-light", "mt-2", "text-white");
            buttonElement.innerText = "Send review";
            shopReviewContainer.appendChild(buttonElement);


            buttonElement.addEventListener('click',function (){

                const form = document.createElement('form');
                form.action = '{{route('user.shop_reviews.store')}}';
                form.method = 'post';

                form.appendChild(createInputElementHidden('_token','{{csrf_token()}}'));
                form.appendChild(createInputElementHidden('shop_id',order.shop_id));
                form.appendChild(createInputElementHidden('rating',shopRatingView.getRating()));
                form.appendChild(createInputElementHidden('review',textArea.value));
                document.getElementsByClassName('container-fluid')[0].append(form);
                form.submit();
                form.remove();

            });
        }

        for(let i=0;i<order.carts.length;i++){
            const productItemReview = getProductItemReview(order.carts[i].product_item_id);

            if(productItemReview!=null){
                const productRatingView = new RatingView(productItemReview.rating);
                productReviewContainer[i].appendChild(productRatingView.getView());
                productRatingViews.push(productRatingView);

                const text = document.createElement('p');
                text.classList.add('mt-2');
                text.innerText  = productItemReview.review;
                productReviewContainer[i].appendChild(text);

                const buttonElement = document.createElement('button');
                buttonElement.classList.add("btn", "btn-light" ,"waves-effect", "waves-light", "mt-2", "text-white", "mt-2");
                buttonElement.innerText = "Already reviewed";
                buttonElement.disabled = true;
                productReviewContainer[i].appendChild(buttonElement);


            }else{
                const productRatingView = new RatingView();
                productReviewContainer[i].appendChild(productRatingView.getView());
                productRatingViews.push(productRatingView);


                const textArea = document.createElement('textarea');
                textArea.classList.add("form-control", 'mt-2');
                textArea.rows = 2;
                textArea.placeholder = "Review";
                productReviewContainer[i].appendChild(textArea);

                const buttonElement = document.createElement('button');
                buttonElement.classList.add("btn", "btn-primary" ,"waves-effect", "waves-light", "mt-2", "text-white", "mt-2");
                buttonElement.innerText = "Send Review";
                productReviewContainer[i].appendChild(buttonElement);

                buttonElement.addEventListener('click',function (){

                    const form = document.createElement('form');
                    form.action = '{{route('user.product_reviews.store')}}';
                    form.method = 'post';

                    form.appendChild(createInputElementHidden('_token','{{csrf_token()}}'));
                    form.appendChild(createInputElementHidden('order_id',order.id));
                    form.appendChild(createInputElementHidden('product_item_id',order.carts[i].product_item_id));
                    form.appendChild(createInputElementHidden('rating',productRatingView.getRating()));
                    form.appendChild(createInputElementHidden('review',textArea.value));
                    document.getElementsByClassName('container-fluid')[0].append(form);
                    form.submit();
                    form.remove();

                });

            }
        }

        if(order.delivery_boy){
            if(order.delivery_boy_review){
                const deliveryBoyRatingView = new RatingView(order.delivery_boy_review.rating);
                deliveryBoyReviewContainer.appendChild(deliveryBoyRatingView.getView());

                const text = document.createElement('p');
                text.classList.add('mt-2');
                text.innerText =order.delivery_boy_review.review;
                deliveryBoyReviewContainer.appendChild(text);

                const buttonElement = document.createElement('button');
                buttonElement.classList.add("btn", "btn-light" ,"waves-effect", "waves-light", "mt-2", "text-white", "mt-2");
                buttonElement.innerText = "Already reviewed";
                buttonElement.disabled = true;
                deliveryBoyReviewContainer.appendChild(buttonElement);

            }else{
                const deliveryBoyRatingView = new RatingView();
                deliveryBoyReviewContainer.appendChild(deliveryBoyRatingView.getView());

                const textArea = document.createElement('textarea');
                textArea.classList.add("form-control", 'mt-2');
                textArea.rows = 2;
                textArea.placeholder = "Review";
                deliveryBoyReviewContainer.appendChild(textArea);

                const buttonElement = document.createElement('button');
                buttonElement.classList.add("btn", "btn-primary" ,"waves-effect", "waves-light", "mt-2", "text-white");
                buttonElement.innerText = "Send review";
                deliveryBoyReviewContainer.appendChild(buttonElement);


                buttonElement.addEventListener('click',function (){

                    const form = document.createElement('form');
                    form.action = '{{route('user.delivery_boy_reviews.store')}}';
                    form.method = 'post';

                    form.appendChild(createInputElementHidden('_token','{{csrf_token()}}'));
                    form.appendChild(createInputElementHidden('order_id',order.id));
                    form.appendChild(createInputElementHidden('rating',deliveryBoyRatingView.getRating()));
                    form.appendChild(createInputElementHidden('review',textArea.value));
                    document.getElementsByClassName('container-fluid')[0].append(form);
                    form.submit();
                    form.remove();

                });

            }
        }




        function getProductItemReview($productItemId){
            for(let i=0;i<order.product_item_reviews.length;i++){
                console.log($productItemId);
                if(order.product_item_reviews[i].product_item_id===$productItemId){
                    return order.product_item_reviews[i];
                }
            }
            return null;
        }



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
