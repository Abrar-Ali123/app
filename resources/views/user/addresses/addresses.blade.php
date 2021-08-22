@extends('user.layouts.app', ['title' => 'Addresses'])

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
                            <li class="breadcrumb-item active">{{__('user.addresses')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.addresses')}}</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-0">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <a type="button" href="{{route('user.addresses.create')}}"
                               class="btn btn-primary waves-effect waves-light mb-2 text-white">{{__('user.add_new_address')}}
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="row">


                    @foreach($addresses as $address)
                        <div class="col-md-6 mt-2">
                            <div class="border p-3 rounded mb-3 mb-md-0">
                                <span class="h5">Address #{{$loop->index+1}}</span>
                                <div class="float-right">
                                    <a target="_blank"
                                       href="{{\App\Models\Order::generateGoogleMapLocationUrl($address->latitude,$address->longitude)}}">
                                        <i class="mdi mdi-eye text-muted font-20"></i></a>
                                </div>
                                <p class="mb-2 mt-2"><span
                                        class="font-weight-semibold mr-2">{{__('user.address')}}:</span>
                                    {{$address->address}}</p>
                                @if($address->address2)
                                    <p class="mb-2 mt-2"><span class="font-weight-semibold mr-2">{{__('user.address')}} 2:</span>
                                        {{$address->address2}}</p>
                                @endif
                                <p class="mb-2"><span class="font-weight-semibold mr-2">{{__('user.city')}}:</span>
                                    {{$address->city}}
                                </p>
                                <p class="mb-2"><span class="font-weight-semibold mr-2">{{__('user.pincode')}}:</span>
                                    {{$address->pincode}}
                                </p>

                            </div>
                        </div>
                    @endforeach


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
