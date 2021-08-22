@extends('manager.layouts.app', ['title' => 'Edit Shop'])

@section('css')
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
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
                                    href="{{route('manager.shops.index')}}">{{__('manager.my_shop')}}</a></li>
                            <li class="breadcrumb-item active">{{__('manager.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.edit_shop')}}</h4>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{route('manager.shops.update',['id'=>$shop->id])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h4 class="card-title">{{__('manager.general')}}</h4>
                                </div>


                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="image">{{__('manager.shop_image')}}</label>
                                                <input type="file" name="image" id="image" data-plugins="dropify"
                                                       data-default-file="{{asset('/storage/'.$shop->image_url)}}" data-min-height="400"  data-max-width="1000" data-errors-position="outside"
                                                       class="form-control"/>

                                                <p class="text-muted text-center mt-2 mb-0">{{__('manager.upload_image')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mt-0">
                                                        <label for="name">{{__('manager.name')}}</label>
                                                        <input type="text"
                                                               class="form-control @if($errors->has('name')) is-invalid @endif"
                                                               id="name" placeholder="Name" name="name"
                                                               value="{{$shop->name}}">
                                                        @if($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group mt-0">
                                                        <label for="email">{{__('manager.email')}}</label>
                                                        <input type="text"
                                                               class="form-control @if($errors->has('email')) is-invalid @endif"
                                                               id="email" placeholder="Email" name="email"
                                                               value="{{$shop->email}}">
                                                        @if($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group mt-0">
                                                        <label for="mobile">{{__('manager.mobile')}}</label>
                                                        <input type="tel"
                                                               class="form-control @if($errors->has('mobile')) is-invalid @endif"
                                                               id="mobile" placeholder="091-8469435337" name="mobile"
                                                               value="{{$shop->mobile}}">
                                                        @if($errors->has('mobile'))
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="summernote">{{__('manager.description')}}</label>
                                    <textarea id="summernote" name="description"
                                              class="@if($errors->has('description')) is-invalid @endif">{{$shop->description}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h4 class="card-title">{{__('manager.location')}}</h4>
                                </div>

                                <div class="col-lg-7 mt-2">
                                    <div id="map" style="height: 500px;width: 100%"></div>
                                </div>
                                <div class="col-lg-5 mt-2">

                                    <div class="col-12">
                                        <div class="form-group mt-0">
                                            <label for="address">{{__('manager.address')}}</label>
                                            <input type="text"
                                                   class="form-control @if($errors->has('address')) is-invalid @endif"
                                                   id="address" placeholder="Address" name="address"
                                                   value="{{$shop->address}}">
                                            @if($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-0">
                                            <label for="latitude">{{__('manager.latitude')}}</label>
                                            <input type="text"
                                                   class="form-control @if($errors->has('latitude')) is-invalid @endif"
                                                   id="latitude" placeholder="Latitude" name="latitude"
                                                   value="{{$shop->latitude}}">
                                            @if($errors->has('latitude'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-0">
                                            <label for="longitude">{{__('manager.longitude')}}</label>
                                            <input type="text"
                                                   class="form-control @if($errors->has('longitude')) is-invalid @endif"
                                                   id="longitude" placeholder="Longitude" name="longitude"
                                                   value="{{$shop->longitude}}">
                                            @if($errors->has('longitude'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="row">




                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h4 class="card-title">{{__('manager.delivery_boy')}}</h4>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" id="available_for_delivery"
                                               name="available_for_delivery"
                                               @if($shop->available_for_delivery) checked @endif>
                                        <label class="custom-control-label"
                                               for="available_for_delivery">{{__('manager.available_for_delivery')}}</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="delivery_range">{{__('manager.delivery_range')}}</label>
                                        <div class="input-group">

                                            <input type="number" step="1" min="0"
                                                   class="form-control @if($errors->has('delivery_range')) is-invalid @endif"
                                                   id="delivery_range" placeholder="Delivery Range" name="delivery_range"
                                                   value="{{$shop->delivery_range}}" disabled>
                                            @if($errors->has('delivery_range'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('delivery_range') }}</strong>
                                        </span>
                                            @endif

                                            <div class="input-group-append">
                                                <span class="input-group-text"
                                                      id="basic-addon1">Meter</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="minimum_delivery_charge">{{__('manager.minimum_delivery_charge')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                      id="basic-addon1">{{\App\Helpers\AppSetting::$currencySign}}</span>
                                            </div>
                                            <input type="number" step="1" min="0"
                                                   class="form-control @if($errors->has('minimum_delivery_charge')) is-invalid @endif"
                                                   id="minimum_delivery_charge" placeholder="{{__('manager.minimum_delivery_charge')}}" name="minimum_delivery_charge"
                                                   value="{{$shop->minimum_delivery_charge}}" disabled>
                                            @if($errors->has('minimum_delivery_charge'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('minimum_delivery_charge') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="delivery_cost_multiplier">{{__('manager.delivery_cost_multiplier')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                      id="basic-addon1">{{\App\Helpers\AppSetting::$currencySign}}</span>
                                            </div>
                                            <input type="number" step="1" min="0"
                                                   class="form-control @if($errors->has('delivery_cost_multiplier')) is-invalid @endif"
                                                   id="delivery_cost_multiplier" placeholder="{{__('manager.delivery_cost_multiplier')}}" name="delivery_cost_multiplier"
                                                   value="{{$shop->delivery_cost_multiplier}}" disabled>
                                            @if($errors->has('delivery_cost_multiplier'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('delivery_cost_multiplier') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h4 class="card-title">{{__('manager.other')}}</h4>
                                </div>

                                <div class="col-12 col-md-12 mb-3">
                                    <div class="custom-checkbox custom-control">
                                        <input class="custom-control-input" type="checkbox" name="open" id="open"
                                               @if($shop->open) checked @endif>
                                        <label class="custom-control-label" for="open">{{__('manager.open')}}</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="default_tax">{{__('manager.default_tax')}}</label>
                                        <div class="input-group">
                                            <input type="number" step="1" min="0"
                                                   class="form-control @if($errors->has('default_tax')) is-invalid @endif"
                                                   id="default_tax" placeholder="Default Tax" name="default_tax"
                                                   value="{{$shop->default_tax}}" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                            @if($errors->has('default_tax'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('default_tax') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="admin_commission">{{__('manager.admin_commission')}}</label>
                                        <div class="input-group">
                                            <input type="number" step="1"
                                                   class="form-control"
                                                   id="admin_commission" placeholder="{{__('manager.admin_commission')}}" name="admin_commission"
                                                   value="{{$shop->admin_commission}}" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"
                                                      id="basic-addon1">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>

                    <div class="col mt-3 mb-3">
                        <div class="text-right">
                            <a href="{{route('manager.shops.index')}}" type="button"
                               class="btn w-sm btn-light waves-effect">{{__('manager.cancel')}}</a>
                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light">{{__('manager.update')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['bold', 'italic']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ]
            })
        });
    </script>

    <script>


        let infoWindow, map;
        let longitudeText, latitudeText;

        init();

        function init() {

            latitudeText = document.getElementById('latitude');
            longitudeText = document.getElementById('longitude');

            latitudeText.addEventListener('change', function () {
                setLocationToMap(latitudeText.value, longitudeText.value);
            })


            longitudeText.addEventListener('change', function () {
                setLocationToMap(latitudeText.value, longitudeText.value);
            })

        }


        function initMap() {


            map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(-33.863276, 151.207977),
                zoom: 12,

            });
            infoWindow = new google.maps.InfoWindow;
            map.setOptions({draggableCursor: 'pointer'});

            google.maps.event.addListener(map, 'click', function (event) {
                setLocationToMap(event.latLng.lat(), event.latLng.lng());
                setLocationToText(event.latLng.lat(), event.latLng.lng())
            });

            // Change this depending on the name of your PHP or XML file
        }

        function setLocationToText(latitude, longitude) {

            latitudeText.value = latitude.toString();
            longitudeText.value = longitude.toString();
        }


        function setLocationToMap(latitude, longitude, byLocation = false) {
            const pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude),
            };
            infoWindow.setPosition(pos);
            if (byLocation)
                infoWindow.setContent("You are here");
            else
                infoWindow.setContent("You select here");
            infoWindow.open(map);
            const zoom = map.getZoom();
            map.setZoom(zoom > 18 ? zoom : 18);
            map.setCenter(pos);
        }


    </script>

    <script async
            src="https://maps.googleapis.com/maps/api/js?key={{\App\Helpers\AppSetting::$GOOGLE_MAP_API_KEY}}&callback=initMap">
    </script>

    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-summernote.init.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
