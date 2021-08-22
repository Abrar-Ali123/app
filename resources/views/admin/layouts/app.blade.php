<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.shared/title-meta', ['title' => $title])
    @include('admin.layouts.shared/head-css')
    {{-- @include('layouts.shared/head-css', ["demo" => "modern"]) --}}
</head>

<body @yield('body-extra')>
<!-- Begin page -->
<div id="wrapper">
    @include('admin.layouts.shared/topbar')

    @include('admin.layouts.shared/left-sidebar')


    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        <!-- content -->

        @include('admin.layouts.shared/footer')

    </div>
</div>
<!-- END wrapper -->

@include('admin.layouts.shared.right-sidebar')


@include('admin.layouts.shared/footer-script')

</body>
</html>
