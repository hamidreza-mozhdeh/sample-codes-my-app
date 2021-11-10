<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')

    <title>@yield('main-title')</title>
</head>
<body>

@include('layouts.nav-main')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-@yield('main-section-width', 8) shadow rounded p-5">
            @yield('main-section-content')
        </div>
    </div>
</div>

@include('layouts.footer')

@include('layouts.footer-script')

</body>
</html>
