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
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset ('admin/assets/images/favicon.png')}}">
    <link href="{{ asset ('admin/assets/plugins/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('admin/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('admin/assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- <style>
    .admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
}

.logo {
    z-index: 1000; /* Atur nilai z-index yang tinggi */
    position: relative;
}

.logo img {
    height: 60px;
    width: 180px;
}

.admin-actions {
    display: flex;
    align-items: center;
}

.action-icon {
    margin-right: 15px;
    color: #fff;
    font-size: 20px;
}

.logout-btn {
    background-color: transparent;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
}

.logout-btn:hover {
    text-decoration: underline;
}
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #fff; /* Warna background putih */
    position: fixed;
    top: 0;
    left: -250px;
    transition: left 0.3s ease;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan */
    padding-top: 60px; /* Padding untuk menghindari tumpukan dengan header */
    z-index: 999;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 10px 15px;
    border-bottom: 1px solid #ccc;
}

.sidebar ul li a {
    color: #333;
    text-decoration: none;
}

.sidebar ul li a i {
    margin-right: 10px;
}

.sidebar.open {
    left: 0;
}

.nav-link {
    color: #333 !important;
}

    
    </style> -->
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
    <script src="{{ asset ('admin/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset ('admin/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset ('admin/js/waves.js') }}"></script>
    <script src="{{ asset ('admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset ('admin/js/custom.js') }}"></script>
    <script src="{{ asset ('admin/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset ('admin/assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset ('admin/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="{{ asset ('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- <script>

document.getElementById("toggle-sidebar").addEventListener("click", function() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("open");
});

</script> -->
    @yield('js')
</body>
</html>