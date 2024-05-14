<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Showroom Sinarmas</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('user/css/slick.css') }}" rel="stylesheet">
		<link href="{{ asset('user/css/slick-theme.css') }}" rel="stylesheet">
		<link href="{{ asset('user/css/nouislider.min.css') }}" rel="stylesheet">
		<link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<header>
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i>0851-5658-5108</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> showroom.sinarmas@gmail.com</a></li>

            </ul>
			<ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-map-marker"></i> Jl. PB Sudirman No. 14, Kec. Patrang, Jember (Jumat-Sabtu, 16.00-22.00 WIB)</a></li>
				<li><a href="#"><i class="fa fa-map-marker"></i> Jl. Jayanegara, Kec. Kaliwates, Jember (Minggu-Kamis, 08.00-17.00 WIB)</a></li>
            </ul>
            <ul class="header-links pull-right">
                @if(Auth::check())
					<li><a href="#"><i class="fa fa-user-o"></i> {{ Auth::user()->name }}</a></li>
					<li>
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" id="logout-button" class="btn btn-primary"><i class="fa fa-sign-out" style="color: white;"></i> Logout</button>
						</form>
					</li>
				@else
					<li>
						<form id="login-form" method="POST">
							@csrf
							<button type="submit" class="btn btn-primary"><i class="fa fa-sign-in" style="color: white;"></i> Login</button>
						</form>
					</li>
				@endif
            </ul>
        </div>
    </div>
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{ asset('admin/assets/images/logo-teks.png') }}" style="width: 240px; height: 80px;" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
								@foreach ($categories as $category)
                                <option value="">{{$category->name}}</option>
								@endforeach
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
						<div>
							<a href="#" id="jadwalLink">
								<i class="fa fa-calendar"></i>
								<span>Jadwal Anda</span>
							</a>
						</div>
                        <!-- /Cart -->
                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
	@include('layout-user.navbar')
    <main>
	<a href="https://wa.me/6281336881004" class="whatsapp-float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
	</a>
    @yield('content')
    </main>

    <footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
                                    <li><a href="#"><i class="fa fa-phone"></i>0851-5658-5108</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>showroom.sinarmas@gmail.com</a></li>
									<li><a href="#"><i class="fa fa-map-marker"></i>Jl. PB Sudirman No. 14, Jember</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Showroom Sinarmas</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
    </footer>
    <script src="{{ asset('user/js/jquery.min.js') }}"></script>
	<script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('user/js/slick.min.js') }}"></script>
	<script src="{{ asset('user/js/nouislider.min.js') }}"></script>
	<script src="{{ asset('user/js/jquery.zoom.min.js') }}"></script>
	<script src="{{ asset('user/js/main.js') }}"></script>
	<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
	<script src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('user/modal/logout.js') }}"></script>
	<script src="{{ asset('user/modal/jadwal.js') }}"></script>
    @yield('js')    
</body>
</html>