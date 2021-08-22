@extends('admin.layouts.app', ['title' => 'Shop'])

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
                                    href="{{route('admin.shops.index')}}">{{__('admin.shop')}}</a></li>
                            <li class="breadcrumb-item active"># {{$shop->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$shop->name}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-9">
                <div class="card-box pb-2">
                    <div class="float-right d-none d-md-inline-block">
                        <h4 class="header-title mb-3">{{__('admin.current_week')}}</h4>
                    </div>

                    <h4 class="header-title mb-3">{{__('admin.sales_analytics')}}</h4>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('admin.weekly_orders')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                                <span>{{$total_weekly_orders}}</span>
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('admin.weekly_selling')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                <span>{{$total_weekly_products}}</span>
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-0 mt-3">{{__('admin.weekly_revenue')}}</p>
                            <h2 class="font-weight-normal mb-3">
                                <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                <span>${{$total_weekly_revenue}}</span>
                            </h2>
                        </div>
                    </div>
                    {{$chart->container()}}

                </div> <!-- end card-box -->
            </div>
            <div class="col-xl-3">
                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{$revenue}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('admin.total_revenue')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-basket font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$orders_count}}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('admin.orders')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-12">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-store font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$products_count}}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('admin.products_sell')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <img class="card-img-top" style="object-fit: cover" height="300"
                                     src="{{asset('/storage/'.$shop->image_url)}}"
                                     alt="Card image cap">
                            </div>
                            <div class="col-12 mt-3">
                                <h4 class="card-title">
                                    {{$shop->name}}
                                </h4>
                                <div class="row">
                                    <div class="col-1">
                                        <i class="far fa-envelope mr-1"></i>
                                    </div>
                                    <div class="col">
                                        <span> {{$shop->email}}</span>
                                    </div>
                                </div>
                                <div class="mt-2 row">
                                    <div class="col-1">
                                        <i class="far fa-map mr-1"></i>
                                    </div>
                                    <div class="col">
                                        <span> {{$shop->address}}</span>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col">
                                        <a class="btn btn-outline-primary waves-effect waves-light mr-2"
                                           href="{{route('admin.shops.reviews.show',['id'=> $shop->id])}}">
                                            <i class="mdi mdi-star-outline mr-1"></i> {{__('admin.review')}}
                                        </a>

                                        <a target="_blank" class="  btn btn-outline-primary waves-effect waves-light"
                                           href="{{\App\Models\Shop::generateGoogleMapLocationUrl($shop->latitude,$shop->longitude)}}">
                                            <i class="mdi mdi-map-marker-outline mr-1"></i> {{__('manager.location')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="row">
                    @if($shop['manager'])
                        <div class="col-12">
                            <div class="card-title">
                                <h5>{{__('admin.managed_by')}}</h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget-rounded-circle card-box">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            <img src="{{asset('storage/'.$shop['manager']->avatar_url)}}"
                                                 class="img-fluid rounded-circle" alt="user-img"/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="mb-1 mt-2">{{$shop['manager']->name}}</h5>
                                        <p class="mb-2 text-muted">{{$shop['manager']->email}}</p>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card-title">
                                <h5>Assign to</h5>
                            </div>
                        </div>
                        @foreach($available_managers as $manager)
                            <div class="col-12">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{asset('storage/'.$manager->avatar_url)}}"
                                                     class="img-fluid rounded-circle" alt="user-img"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="mb-1 mt-2">{{$manager->name}}</h5>
                                            <p class="mb-2 text-muted">{{$manager->email}}</p>
                                        </div>
                                        <div class="col">
                                            <div class="text-right">
                                                <form
                                                    action="{{route('admin.shops.update',['id'=>$shop->id])}}"
                                                    method="post">
                                                    @csrf
                                                    {{method_field('PATCH')}}
                                                    <input type="hidden" name="manager_id" value="{{$manager->id}}">
                                                    <button type="submit" name="action" value="assign_manager"
                                                            class="btn btn-primary waves-effect waves-light">
                                                        Assign
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

        </div>


    </div>

@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ $chart->cdn() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}
@endsection
