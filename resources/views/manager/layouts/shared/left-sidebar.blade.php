<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">


                <li>
                    <a href="{{route('manager.dashboard')}}">
                        <i data-feather="activity"></i>
                        <span> {{__('manager.dashboard')}} </span>
                    </a>
                </li>

                <li class="menu-title">{{__('manager.navigation')}}</li>

                <li>
                    <a href="{{route('manager.orders.index')}}">
                        <i data-feather="shopping-bag"></i>
                        <span>  {{__('manager.orders')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('manager.products.index')}}">
                        <i data-feather="server"></i>
                        <span> {{__('manager.product')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('manager.reviews.index')}}">
                        <i data-feather="star"></i>
                        <span> {{__('manager.reviews')}} </span>
                    </a>
                </li>


                <li>
                    <a href="{{route('manager.shops.index')}}">
                        <i data-feather="home"></i>
                        <span>  {{__('manager.my_shop')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('manager.delivery-boys.index')}}">
                        <i data-feather="truck"></i>
                        <span> {{__('manager.delivery_boy')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('manager.coupons.index')}}">
                        <i data-feather="tag"></i>
                        <span>  {{__('manager.coupon')}}  <span
                                class="badge badge-primary ml-1">{{__('manager.BETA')}}</span> </span>
                    </a>
                </li>


                <li class="menu-title">{{__('manager.transaction')}}</li>


                <li>
                    <a href="{{route('manager.shop-revenues.index')}}">
                        <i data-feather="airplay"></i>
                        <span>  {{__('manager.shop_revenues')}} </span>
                    </a>
                </li>


                <li>
                    <a href="{{route('manager.transaction.index')}}">
                        <i data-feather="dollar-sign"></i>
                        <span>  {{__('manager.transaction')}} </span>
                    </a>
                </li>


                <li class="menu-title">{{__('manager.other')}}</li>

                <li>
                    <a href="{{route('manager.setting.edit')}}">
                        <i data-feather="settings">></i>
                        <span> {{__('manager.setting')}} </span>
                    </a>
                </li>

            </ul>

            <div class="text-center mt-3 menu-title"  style="pointer-events: all;">
                <a href="https://codecanyon.net/item/emall-multi-vendor-ecommerce-full-app/29955830" target="_blank"
                   class="text-center btn btn-primary btn-sm">BUY NOW</a>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
