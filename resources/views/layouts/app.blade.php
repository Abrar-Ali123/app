<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => $title])
    @include('layouts.shared/head-css')
    {{-- @include('layouts.shared/head-css', ["demo" => "modern"]) --}}
</head>

<body @yield('body-extra')>
<!-- Begin page -->
<div id="wrapper">
    @include('layouts.shared/topbar')

    @include('layouts.shared/left-sidebar')


    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
        <!-- content -->

        @include('layouts.shared/footer')

    </div>
</div>
<!-- END wrapper -->

@include('layouts.shared/footer-script')

</body>
</html>
