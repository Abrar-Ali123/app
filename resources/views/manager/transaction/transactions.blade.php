@extends('manager.layouts.app', ['title' => 'Transactions'])

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
                            <li class="breadcrumb-item active">{{__('manager.transactions')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('manager.transactions')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl col-md-6">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded bg-soft-danger">
                                <i class="dripicons-arrow-up font-24 avatar-title text-danger"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">{{\App\Helpers\AppSetting::$currencySign}}<span data-plugin="counterup">{{\App\Helpers\CurrencyUtil::doubleToString($pay_to_admin)}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('manager.pay_to_admin')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div>

            <div class="col-xl col-md-6">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded bg-soft-primary">
                                <i class="dripicons-arrow-down font-24 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">{{\App\Helpers\AppSetting::$currencySign}}<span data-plugin="counterup">{{\App\Helpers\CurrencyUtil::doubleToString($take_from_admin)}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('manager.take_from_admin')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if($transactions->count()>0)
                    <div class="row justify-content-between mx-1">

                    <h4>{{__('manager.payment')}}</h4>

                            {{ $transactions->links() }}
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered  table-nowrap table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th colspan="2" class="text-center">{{__('manager.payment')}}</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>{{__('manager.order')}} ID</th>

                                        <th>{{__('manager.pay_to_admin')}}</th>
                                        <th>{{__('manager.take_from_admin')}}</th>

                                        <th>{{__('manager.total')}}</th>

                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <a href="{{route('manager.orders.edit',['id'=>$transaction['order']['id']])}}"
                                                   class="font-weight-semibold"># {{$transaction['order']['id']}}</a>
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['shop_to_admin'])}}
                                            </td>
                                            <td>
                                                {{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['admin_to_shop'])}}
                                            </td>

                                            <td>{{\App\Helpers\AppSetting::$currencySign}} {{\App\Helpers\CurrencyUtil::doubleToString($transaction['total'])}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h3>{{__('admin.there_is_no_any_revenues_yet')}}</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection

@section('script')

@endsection
