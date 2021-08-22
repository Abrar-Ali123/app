<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">


                <li>
                    <a href="{{route('user.dashboard')}}">
                        <i data-feather="home"></i>
                        <span> {{__('user.home')}} </span>
                    </a>
                </li>

                <li class="menu-title">{{__('manager.navigation')}}</li>

                <li>
                    <a href="{{route('user.products.index')}}">
                        <i data-feather="server"></i>
                        <span>  {{__('user.products')}} </span>
                    </a>
                </li>



                <li>
                    <a href="{{route('user.carts.index')}}">
                        <i data-feather="shopping-cart"></i>
                        <span>  {{__('user.carts')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('user.orders.index')}}">
                        <i data-feather="shopping-bag"></i>
                        <span>  {{__('user.orders')}} </span>
                    </a>
                </li>



                <li class="menu-title">{{__('user.other')}}</li>
                <li>
                    <a href="{{route('user.favorites.index')}}">
                        <i data-feather="heart"></i>
                        <span>  {{__('user.favorites')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.addresses.index')}}">
                        <i data-feather="map-pin"></i>
                        <span>  {{__('user.addresses')}} </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('user.setting.edit')}}">
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
