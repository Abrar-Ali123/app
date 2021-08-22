@extends('admin.layouts.app', ['title' => 'Edit Shop'])

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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.shops.index')}}">{{__('manager.my_shop')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.edit_shop')}}</h4>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{route('admin.shops.update',['id'=>$shop->id])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h4 class="card-title">{{__('admin.general')}}</h4>
                                </div>


                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="image">{{__('admin.shop_image')}}</label>
                                                <input type="file" name="image" id="image" data-plugins="dropify"
                                                       data-default-file="{{asset('/storage/'.$shop->image_url)}}"
                                                       class="form-control"/>

                                                <p class="text-muted text-center mt-2 mb-0">{{__('admin.upload_image')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mt-0">
                                                        <label for="name">{{__('admin.name')}}</label>
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
                                                        <label for="email">{{__('admin.email')}}</label>
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
                                                        <label for="mobile">{{__('admin.mobile')}}</label>
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
                                    <label for="summernote">{{__('admin.description')}}</label>
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
                                    <h4 class="card-title">{{__('admin.location')}}</h4>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mt-0">
                                        <label for="address">{{__('admin.address')}}</label>
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

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="latitude">{{__('admin.latitude')}}</label>
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

                                <div class="col-12 col-md-6">
                                    <div class="form-group mt-0">
                                        <label for="longitude">{{__('admin.longitude')}}</label>
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
                                                   value="{{$shop->delivery_range}}">
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
                                                   value="{{$shop->minimum_delivery_charge}}">
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
                                                   value="{{$shop->delivery_cost_multiplier}}">
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
                                                   value="{{$shop->default_tax}}">
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
                                                   value="{{$shop->admin_commission}}">
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
                            <a href="{{route('admin.shops.index')}}" type="button"
                               class="btn w-sm btn-light waves-effect">{{__('admin.cancel')}}</a>
                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light">{{__('admin.update')}}
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
            }).code("{{$shop->description}}")
        });
    </script>

    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-summernote.init.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
