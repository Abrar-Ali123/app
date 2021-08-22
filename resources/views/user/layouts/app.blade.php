<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.shared/title-meta', ['title' => $title])
    @include('user.layouts.shared/head-css')
    {{--@include('layouts.shared/head-css', ["demo" => "dark"])--}}
</head>

<body @yield('body-extra')>
<!-- Begin page -->
<div id="wrapper">
    @include('user.layouts.shared/topbar')

    @include('user.layouts.shared/left-sidebar')


    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        <!-- content -->

        @include('user.layouts.shared/footer')

    </div>
</div>
<!-- END wrapper -->

@include('user.layouts.shared.right-sidebar')


@include('user.layouts.shared/footer-script')

</body>
</html>
