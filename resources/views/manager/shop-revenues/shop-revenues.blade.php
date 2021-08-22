@extends('manager.layouts.app', ['title' => 'Shop Revenues'])

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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.shop_revenues')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.shop_revenues')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="float-right">
                            {{ $shop_revenues->links() }}
                        </div>

                        @if(count($shop_revenues)>0)

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('manager.order')}} ID</th>
                                    <th>{{__('manager.products')}}</th>
                                    <th>{{__('manager.total_products')}}</th>
                                    <th>{{__('manager.revenue')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shop_revenues as $shop_revenue)
                                    <tr>
                                        <td>
                                            <a href="{{route('manager.orders.edit',['id'=>$shop_revenue['order_id']])}}" class="font-weight-semibold">#{{$shop_revenue['order_id']}}</a>
                                        </td>
                                        <td>
                                            @foreach($shop_revenue['order']['carts'] as $cart)
                                                @if(count($cart['product']['productImages'])!=0)
                                                <img src="{{\App\Helpers\TextUtil::getImageUrl($cart['product']['productImages'][0]['url'],\App\Helpers\TextUtil::$PLACEHOLDER_PRODUCT_IMAGE_URL)}}"
                                                     style="object-fit: cover" alt="OOps"
                                                     height="64px"
                                                     width="64px">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                         style="object-fit: cover" alt="OOps" class="m-1"
                                                         height="60px"
                                                         width="60px">
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$shop_revenue['products_count']}}
                                        </td>
                                        <td>
                                          {{\App\Helpers\AppSetting::$currencySign}}  {{$shop_revenue['revenue']}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        @else
                            <div>
                                <h4>{{__('manager.there_is_no_any_revenues_yet')}}</h4>
                            </div>
                        @endif

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
