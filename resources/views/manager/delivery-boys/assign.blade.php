@extends('manager.layouts.app', ['title' => 'Assign - Delivery Boy'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('manager.delivery_boy')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.assign')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.assign_for_this_order')}}</h4>
                </div>
            </div>
        </div>


        @if($delivery_boys->count()>0)
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('manager.image')}}</th>
                                        <th>{{__('manager.name')}}</th>
                                        <th>{{__('manager.status')}}</th>
                                        <th>{{__('manager.rating')}}</th>
                                        <th>{{__('manager.far_from_shop')}}</th>
                                        <th style="width: 82px;">{{__('manager.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($delivery_boys as $delivery_boy)
                                        <tr>
                                            <td>{{$delivery_boy->id}}
                                            </td>
                                            <td>

                                                <img
                                                    src="{{\App\Helpers\TextUtil::getImageUrl($delivery_boy['avatar_url'],\App\Helpers\TextUtil::$PLACEHOLDER_AVATAR_URL)}}"
                                                    alt="image" class="img-fluid avatar-sm rounded-circle">
                                            </td>
                                            <td>{{$delivery_boy->name}}</td>
                                            <td>
                                                @if($delivery_boy->is_offline)
                                                    <span class="bg-danger mr-1"
                                                          style="border-radius: 50%;width: 8px;height: 8px;  display: inline-block;"></span> {{__('manager.offline')}}
                                                @else
                                                    <span class="bg-primary mr-1"
                                                          style="border-radius: 50%;width: 8px;height: 8px;  display: inline-block;"></span> {{__('manager.online')}}
                                                @endif

                                            </td>
                                            <td>
                                                @for($i=0;$i<5;$i++)
                                                    <i class="mdi @if($i<$delivery_boy['rating']) mdi-star @else mdi-star-outline @endif"
                                                       style="font-size: 18px; margin-left: -4px; color: @if($i<$delivery_boy['rating'])  {{\App\Helpers\ColorUtil::getColorFromRating($delivery_boy['rating'])}} @else black @endif"></i>
                                                @endfor
                                                <p class="d-inline">({{$delivery_boy['total_rating']}})</p>
                                            </td>
                                            <td>
                                                @if($delivery_boy['far_from_shop']<1000)
                                                    <p>{{round($delivery_boy['far_from_shop'])}} Meter</p>
                                                @else
                                                    <p class="font-weight-semibold">{{round($delivery_boy['far_from_shop']/1000, 2)}} K.M</p>
                                                    @endif

                                            </td>
                                            <td>
                                                <form
                                                    action="{{route('manager.delivery-boys.assign',['order_id'=>$order_id,'delivery_boy_id'=>$delivery_boy->id])}}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm">
                                                        <i class="mdi mdi-pencil-outline mr-1"></i> {{__('manager.assign')}}
                                                    </button>
                                                </form>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3>{{__('manager.there_is_no_any_delivery_boy_free')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div> <!-- container -->

@endsection

@section('script')

@endsection
