@extends('manager.layouts.app', ['title' => 'Shop Reviews'])

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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('manager.shop_reviews')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.shop_reviews')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        @if(count($shopReviews)>0)
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('manager.image')}}</th>
                                        <th>{{__('manager.user_name')}}</th>
                                        <th>{{__('manager.rating')}}</th>
                                        <th>{{__('manager.review')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shopReviews as $shopReview)
                                        <tr>
                                            <td>{{$shopReview['id']}}</td>

                                            <td>
                                                <img
                                                    src="{{\App\Helpers\TextUtil::getImageUrl($shopReview['user']['avatar_url'])}}"
                                                    alt="image" class="img-fluid avatar-sm rounded-circle">
                                            </td>


                                            <td>{{$shopReview['user']['name']}}</td>

                                            <td>
                                                @for($i=0;$i<5;$i++)
                                                    <i class="mdi @if($i<$shopReview['rating']) mdi-star @else mdi-star-outline @endif"
                                                       style="font-size: 18px; margin-left: -4px; color: @if($i<$shopReview['rating']) {{\App\Models\ProductReview::getColorFromRating($shopReview['rating'])}} @else black @endif"></i>
                                                @endfor
                                            </td>
                                            <td>
                                                @if(empty($shopReview['review']))
                                                    {{__('manager.no_review')}}
                                                @else
                                                    {{$shopReview['review']}}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div>
                                <h4>{{__('manager.there_is_no_review_yet')}}</h4>
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
