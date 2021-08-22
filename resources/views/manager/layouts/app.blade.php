<!DOCTYPE html>
<html lang="en">

<head>
    @include('manager.layouts.shared/title-meta', ['title' => $title])
    @include('manager.layouts.shared/head-css')
    {{--@include('layouts.shared/head-css', ["demo" => "dark"])--}}
</head>

<body @yield('body-extra')>
<!-- Begin page -->
<div id="wrapper">
    @include('manager.layouts.shared/topbar')

    @include('manager.layouts.shared/left-sidebar')


    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        <!-- content -->

        @include('manager.layouts.shared/footer')

    </div>
</div>
<!-- END wrapper -->

@include('manager.layouts.shared.right-sidebar')


@include('manager.layouts.shared/footer-script')

</body>
</html>
