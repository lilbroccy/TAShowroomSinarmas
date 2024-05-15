<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Showroom Mobil Bekas Sinarmas">
    <meta name="description" content="Showroom Mobil Bekas Sinarmas">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title') Showroom Sinarmas</title>
    <link href="{{ asset ('admin/assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('admin/assets/plugins/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('admin/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('admin/assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet">
    @yield('css')
    @include('layout-admin.variable')
    
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    
        @include('layout-admin.navbar')
        @include('layout-admin.sidebar')

        <div class="page-wrapper">

        @yield('body')

        <footer class="footer text-center">
                © {{date('Y')}} <a href="#">Showroom Sinarmas</a>
            </footer>
        </div>
    </div>

    <script src="{{ asset ('admin/assets/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset ('admin/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="{{ asset ('admin/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset ('admin/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset ('admin/js/waves.js') }}"></script>
    <script src="{{ asset ('admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset ('admin/js/custom.js') }}"></script>
    <script src="{{ asset ('admin/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset ('admin/assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset ('admin/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="{{ asset ('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    @yield('js')
</body>
</html>