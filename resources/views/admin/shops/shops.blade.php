@extends('admin.layouts.app', ['title' => 'Shops'])

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
                            <li class="breadcrumb-item active">{{__('admin.shops')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.shops')}}</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        {{ $shops->links() }}
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <a type="button" href="{{route('admin.shops.create')}}"
                               class="btn btn-primary waves-effect waves-light text-white">{{__('admin.create_shop')}}
                            </a>
                        </div>
                    </div>
                </div>

                @if($shops->count()>0)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('admin.image')}}</th>
                                        <th>{{__('admin.name')}}</th>
                                        <th>{{__('admin.manager_name')}}</th>
                                        <th>{{__('admin.rating')}}</th>
                                        <th>{{__('admin.products_sell')}}</th>
                                        <th>{{__('admin.shop_revenue')}}</th>
                                        <th style="width: 82px;">{{__('admin.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shops as $shop)
                                        <tr>
                                            <td>{{$shop->id}}
                                            </td>
                                            <td>
                                                <img
                                                    src="{{\App\Helpers\TextUtil::getImageUrl($shop['image_url'],\App\Helpers\TextUtil::$PLACEHOLDER_SHOP_IMAGE_URL)}}"
                                                    alt="image" class="img-fluid rounded" width="100">
                                            </td>
                                            <td>{{$shop->name}}</td>
                                            <td>
                                                @if($shop['manager'])
                                                    {{$shop['manager']->name}}
                                                @else
                                                    <span class="text-danger">{{__('Not assigned')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @for($i=0;$i<5;$i++)
                                                    <i class="mdi @if($i<$shop['rating']) mdi-star @else mdi-star-outline @endif"
                                                       style="font-size: 18px; margin-left: -4px; color: @if($i<$shop['rating'])  {{\App\Helpers\ColorUtil::getColorFromRating($shop['rating'])}} @else black @endif"></i>
                                                @endfor
                                                <p class="d-inline">({{$shop['total_rating']}})</p>
                                            </td>
                                            <td>{{$shop->products_count}}</td>
                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{$shop->revenue}}</td>
                                            <td>
                                                <a href="{{route('admin.shops.show',['id'=>$shop->id])}}"
                                                   style="font-size: 20px"> <i
                                                        class="mdi mdi-eye"></i></a>

                                                <a href="{{route('admin.shops.edit',['id'=>$shop->id])}}" class="ml-1"
                                                   style="font-size: 20px"> <i
                                                        class="mdi mdi-pencil"></i></a>


                                                <a href="{{route('admin.shops.reviews.show',['id'=>$shop->id])}}"
                                                   class="ml-1"
                                                   style="font-size: 20px"> <i class="mdi mdi-star"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <h3>{{__('admin.there_is_no_shop_yet')}}</h3>
                </div>
            </div>
        @endif


    </div>

@endsection

@section('script')

@endsection
