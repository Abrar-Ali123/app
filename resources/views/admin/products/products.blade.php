@extends('admin.layouts.app', ['title' => 'Products'])

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
                            <li class="breadcrumb-item active">{{__('admin.products')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.products')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="float-right">
                            {{ $products->links() }}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{__('admin.image')}}</th>
                                    <th>{{__('admin.name')}}</th>
                                    <th>{{__('admin.rating')}}</th>
                                    <th style="width: 82px;">{{__('admin.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <div>
                                                @if(count($product['productImages'])!=0)
                                                    <img src="{{asset('storage/'.$product['productImages'][0]['url'])}}"
                                                         style="object-fit: cover" alt="OOps"
                                                         height="64px"
                                                         width="64px">
                                                @else
                                                    <img src="{{\App\Models\Product::getPlaceholderImage()}}"
                                                         style="object-fit: cover" alt="OOps"
                                                         height="64px"
                                                         width="64px">
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{$product['name']}}
                                            @if(!$product['active'])
                                                <span
                                                    class="text-danger d-block">* {{__('admin.this_product_was_disabled')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @for($i=0;$i<5;$i++)
                                                <i class="mdi @if($i<$product['rating']) mdi-star @else mdi-star-outline @endif"
                                                   style="font-size: 18px; margin-left: -4px; color: @if($i<$product['rating'])  {{\App\Models\ProductReview::getColorFromRating($product['rating'])}} @else black @endif"></i>
                                            @endfor
                                            <p class="d-inline">({{$product['total_rating']}})</p>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.products.edit',['id'=>$product['id']])}}"
                                               style="font-size: 20px"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>

    </div> <!-- container -->

@endsection

@section('script')
@endsection
