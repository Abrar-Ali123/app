@extends('admin.layouts.app', ['title' => 'Edit Coupon'])

@section('css')
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.coupons.index')}}">{{__('admin.coupon')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.edit_coupon')}}</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.coupons.update',['id'=>$coupon->id])}}" method="post">
                            @csrf
                            {{method_field('PATCH')}}
                            {{--<input type="hidden" name="id" value="{{$category->id}}">--}}

                            <div class="form-group">
                                <label for="code">{{__('admin.coupon_code')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                    <input type="text" class="form-control"
                                           id="code" placeholder="SAVE40" value="{{$coupon->code}}"
                                           name="code" disabled>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="description">{{__('admin.description')}}</label>
                                <textarea name="description" id="description"
                                          class="form-control @if($errors->has('description')) is-invalid @endif"
                                          placeholder="Description">{{$coupon->description}}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="offer">{{__('admin.offer')}} (in %)</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" id="offer" value="{{$coupon->offer}}"
                                           class="form-control @if($errors->has('offer')) is-invalid @endif"
                                           name="offer"
                                           placeholder="Offer" disabled/>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                    @if($errors->has('offer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('offer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group mb-3">
                                <label for="min_order">{{__('admin.min_order')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{\App\Helpers\AppSetting::$currencySign}}</span>
                                    </div>
                                    <input type="number" min="0" max="1000" step="0.1"
                                           class="form-control @if($errors->has('min_order')) is-invalid @endif" name="min_order"
                                           id="min_order" value="{{$coupon->min_order}}"
                                           placeholder="Minimum Order" disabled>

                                    @if($errors->has('min_order'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('min_order') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="max_discount">{{__('admin.max_discount')}} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{\App\Helpers\AppSetting::$currencySign}}</span>
                                    </div>
                                    <input type="number" min="0" max="1000" step="0.1"
                                           class="form-control @if($errors->has('max_discount')) is-invalid @endif" name="max_discount"
                                           id="max_discount" value="{{$coupon->max_discount}}"
                                           placeholder="Max Discount" disabled>

                                    @if($errors->has('max_discount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('max_discount') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="expired_at">{{__('admin.expired_at')}}</label>
                                <input type="date" id="expired_at" min="{{now()->addDays(1)->format('Y-m-d')}}"
                                       value="{{$coupon->expired_at}}" name="expired_at"
                                       class="form-control @if($errors->has('expired_at')) is-invalid @endif">
                                @if($errors->has('expired_at'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expired_at') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" @if($coupon->is_active) checked @endif>
                                <label class="custom-control-label" for="is_active">{{__('admin.coupon_activation')}}</label>
                            </div>



                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('admin.update')}}</button>
                                <a type="button" href="{{route('admin.coupons.index')}}"
                                   class="btn btn-danger waves-effect waves-light m-l-10">{{__('admin.cancel')}}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
