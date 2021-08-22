@extends('user.layouts.app', ['title' => 'Reviews'])

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
                            </li> <li class="breadcrumb-item"><a href="{{route('user.shops.show',['id'=>$shop->id])}}">{{$shop->name}} </a>
                            </li>
                            <li class="breadcrumb-item active">{{__('user.reviews')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$shop->name}} {{__('user.reviews')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
{{--                        <div class="float-right">--}}
{{--                            {{ $reviews->links() }}--}}
{{--                        </div>--}}
                        @if(count($shop->shopReviews)>0)
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('user.user_image')}}</th>
                                        <th>{{__('user.user_name')}}</th>
                                        <th>{{__('user.rating')}}</th>
                                        <th>{{__('user.reviews')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shop->shopReviews as $review)
                                        <tr>
                                            <td>{{$review['id']}}</td>
                                            <td>
                                                <div>

                                                    @if($review['user']['avatar_url'])
                                                        <img src="{{asset('storage/'.$review['user']['avatar_url'])}}"
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
                                            <td>{{$review['user']['name']}}</td>

                                            <td>
                                                @for($i=0;$i<5;$i++)
                                                    <i class="mdi @if($i<$review['rating']) mdi-star @else mdi-star-outline @endif"
                                                       style="font-size: 18px; margin-left: -4px; color: @if($i<$review['rating']) {{\App\Models\ProductReview::getColorFromRating($review['rating'])}} @else black @endif"></i>
                                                @endfor
                                            </td>
                                            <td>
                                                @if(empty($review['review']))
                                                    {{__('user.no_review')}}
                                                @else
                                                    {{$review['review']}}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div>
                                <h4>{{__('user.there_is_no_review_yet')}}</h4>
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
