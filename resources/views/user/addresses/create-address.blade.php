@extends('user.layouts.app', ['title' => 'Create Address'])

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
                            <li class="breadcrumb-item"><a
                                    href="{{route('user.addresses.index')}}">{{__('user.addresses')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('user.create')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('user.create_address')}}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 mt-2">
                <div id="map" style="height: 500px;width: 100%"></div>
            </div>
            <div class="col-lg-5 mt-2">

                <form action="{{route('user.addresses.store')}}" method="POST">
                    @csrf
                    <button type="button" id="useMyLocationBtn" class="btn btn-primary">Use My Location</button>

                    <div class="form-group row mt-3">
                        <label for="address" class="col-sm-2 col-form-label">{{__('user.address')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  @if($errors->has('address')) is-invalid @endif "
                                   id="address" placeholder="{{__('user.address')}}"
                                   name="address" required>
                            @if($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address2" class="col-sm-2 col-form-label">{{__('user.address')}} 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="address2"
                                   placeholder="{{__('user.address')}} 2" name="address2">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="latitude" class="col-sm-2 col-form-label">{{__('user.latitude')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control  @if($errors->has('latitude')) is-invalid @endif "
                                   id="latitude" step="any"
                                   placeholder="{{__('user.latitude')}}" name="latitude" required>
                            @if($errors->has('latitude'))
                                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="longitude" class="col-sm-2 col-form-label">{{__('user.longitude')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control  @if($errors->has('longitude')) is-invalid @endif "
                                   id="longitude" step="any"
                                   placeholder="{{__('user.longitude')}}" name="longitude" required>
                            @if($errors->has('longitude'))
                                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('longitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">{{__('user.city')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  @if($errors->has('city')) is-invalid @endif "
                                   id="city"
                                   placeholder="{{__('user.city')}}" name="city" required>
                            @if($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pincode" class="col-sm-2 col-form-label">{{__('user.pincode')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control  @if($errors->has('pincode')) is-invalid @endif "
                                   id="pincode"
                                   placeholder="{{__('user.pincode')}}" name="pincode" required>
                            @if($errors->has('pincode'))
                                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('pincode') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-between mx-1">

                        <button type="button" onclick="window.history.back();"
                           class="btn btn-outline-secondary">
                            {{__('user.back')}}</button>
                        <button type="submit"
                                class="btn btn-primary"><i class="mdi mdi-cart-plus mr-1"></i>
                        {{__('user.create')}}

                    </div>
                    </button>
                </form>

            </div>
        </div>

    </div> <!-- container -->

@endsection

@section('script')
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


            document.getElementById('useMyLocationBtn').addEventListener('click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            setLocationToText(latitude, longitude);
                            setLocationToMap(latitude, longitude, true);
                        },
                    );
                } else {
                    alert("Browser is not support location");

                }
            });
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

@endsection
