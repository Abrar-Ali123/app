@extends('manager.layouts.app', ['title' => 'Manage Delivery boy'])

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
                            <li class="breadcrumb-item"><a
                                    href="{{route('manager.delivery-boys.index')}}">{{__('manager.delivery_boy')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.manage')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.manage_delivery_boys')}}</h4>
                </div>
            </div>
        </div>

        @if($shop_delivery_boys->count()>0)
          <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <h5>{{__('manager.my_delivery_boys')}}</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('manager.image')}}</th>
                                        <th>{{__('manager.name')}}</th>
                                        <th>{{__('manager.status')}}</th>
                                        <th>{{__('manager.rating')}}</th>
                                        <th style="width: 82px;">{{__('manager.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shop_delivery_boys as $delivery_boy)
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
                                                <form action="{{route('manager.delivery-boys.manage',['id'=>$delivery_boy->id])}}" method="post">
                                                    @csrf
                                                <button type="submit" class="btn btn-danger btn-sm ">{{__('manager.remove')}}</button>
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
            <div>
                <h4 class="mb-3">{{__('manager.you_have_not_any_delivery_boy')}}</h4>
            </div>
        @endif

        @if($unallocated_delivery_boys->count()>0)
          <div class="card">
            <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <h5>{{__('manager.unallocated_delivery_boys')}}</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('manager.image')}}</th>
                                        <th>{{__('manager.name')}}</th>
                                        <th>{{__('manager.status')}}</th>
                                        <th>{{__('manager.rating')}}</th>
                                        <th style="width: 82px;">{{__('manager.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($unallocated_delivery_boys as $delivery_boy)
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
                                                <form action="{{route('manager.delivery-boys.manage',['id'=>$delivery_boy->id])}}" method="post">
                                                    @csrf
                                                <button type="submit" class="btn btn-primary btn-sm ">{{__('manager.add')}}</button>
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
        @endif

        @if($allocated_delivery_boys->count()>0)
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <h5>{{__('manager.allocated_delivery_boys')}}</h5>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('manager.image')}}</th>
                                        <th>{{__('manager.name')}}</th>
                                        <th>{{__('manager.status')}}</th>
                                        <th>{{__('manager.rating')}}</th>
                                        <th style="width: 82px;">{{__('manager.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allocated_delivery_boys as $delivery_boy)
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
                                                <p class="text-info ">{{__('manager.already_allocated_by_other_shop')}}</p>
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
        @endif


    </div>



@endsection

@section('script')

@endsection
