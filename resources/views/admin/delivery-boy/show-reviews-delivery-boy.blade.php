@extends('admin.layouts.app', ['title' => 'Delivery boy Review'])

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
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.delivery-boys.index')}}">{{__('admin.delivery_boy')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.reviews')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.reviews')}}</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">

                @if(count($deliveryBoyReviews)>0)
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>{{__('admin.image')}}</th>
                                <th>{{__('admin.user_name')}}</th>
                                <th>{{__('admin.rating')}}</th>
                                <th>{{__('admin.review')}}</th>
                                <th style="width: 250px;">{{__('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deliveryBoyReviews as $deliveryBoyReview)
                                <tr>
                                    <td>
                                        <img
                                            src="{{\App\Helpers\TextUtil::getImageUrl($deliveryBoyReview['user']['avatar_url'])}}"
                                            alt="image" class="img-fluid avatar-sm rounded-circle">
                                    </td>
                                    <td>{{$deliveryBoyReview['user']['name']}}</td>
                                    <td>
                                        @for($i=0;$i<5;$i++)
                                            <i class="mdi @if($i<$deliveryBoyReview['rating']) mdi-star @else mdi-star-outline @endif"
                                               style="font-size: 18px; margin-left: -4px; color: @if($i<$deliveryBoyReview['rating']) {{\App\Helpers\ColorUtil::getColorFromRating($deliveryBoyReview['rating'])}} @else black @endif"></i>
                                        @endfor
                                    </td>
                                    <td>
                                        @if(empty($deliveryBoyReview['review']))
                                            {{__('admin.no_review')}}
                                        @else
                                            {{$deliveryBoyReview['review']}}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{route('admin.delivery-boy.review.delete',['id'=>$deliveryBoyReview['id']])}}"  method="POST">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button class="btn"><i style="font-size: 20px"
                                                                   class="mdi mdi-trash-can text-danger"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <h4>{{__('admin.there_is_no_review_yet')}}</h4>
                    </div>
                @endif

            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
