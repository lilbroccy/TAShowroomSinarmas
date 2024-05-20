<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
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
	<script type="text/javascript">
		window.$crisp=[];window.CRISP_WEBSITE_ID="6b24d404-7b54-4702-9b58-c1ffd1d7c153";
		(function(){
			var d=document;
			var s=d.createElement("script");
			s.src="https://client.crisp.chat/l.js";
			s.async=1;
			d.getElementsByTagName("head")[0].appendChild(s);
		})();

		document.addEventListener("DOMContentLoaded", function() {
			var logoutButton = document.getElementById('logout-button');
			if (logoutButton) {
				logoutButton.addEventListener('click', function() {
					window.$crisp.push(["do", "session:reset"]);
					localStorage.removeItem('crisp_session_id');
				});
			}
		});

		@auth
			var crispSessionId = localStorage.getItem('crisp_session_id');
			if (crispSessionId) {
				window.$crisp.push(["set", "session:id", crispSessionId]);
			}

			window.$crisp.push(["set", "session:data", [["user_id", "{{ Auth::user()->id }}"]]]);
			window.$crisp.push(["set", "user:email", "{{ Auth::user()->email }}"]);
			window.$crisp.push(["set", "user:nickname", "{{ Auth::user()->name }}"]);
			@if (Auth::user()->phone)
				window.$crisp.push(["set", "user:phone", "{{ Auth::user()->phone }}"]);
			@endif
			window.$crisp.push(["on", "session:init", function(session) {
				localStorage.setItem('crisp_session_id', session.session_id);
			}]);
		@else
			document.addEventListener("DOMContentLoaded", function() {
			var logoutButton = document.getElementById('login-button');
			if (logoutButton) {
				logoutButton.addEventListener('click', function() {
					window.$crisp.push(["do", "session:reset"]);
					localStorage.removeItem('crisp_session_id');
				});
			}
		});
		@endauth
	</script>
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
                            <button type="submit" id="login-button" class="btn btn-primary"><i class="fa fa-sign-in" style="color: white;"></i> Login</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{ asset('admin/assets/images/logo-teks.png') }}" style="width: 240px; height: 80px;" alt="">
                        </a>
                    </div>
                </div>
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
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
						<div>
							<a href="#" data-toggle="modal" data-target="#wishlistModal">
								<i class="fa fa-heart-o"></i>
								<span>Your Wishlist</span>
								<div class="qty">{{ $totalWishlist }}</div>
							</a>
						</div>
						<!-- Modal -->


                        <div>
                            <a href="#" id="jadwalLink">
                                <i class="fa fa-calendar"></i>
                                <span>Jadwal Anda</span>
                            </a>
                        </div>
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@include('layout-user.navbar')
<main>
    <a href="https://wa.me/6281336881004" class="whatsapp-float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
    @yield('content')
</main>

<footer id="footer">
    <div class="section">
        <div class="container">
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
        </div>
    </div>
    <div id="bottom-footer" class="section">
        <div class="container">
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
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Showroom Sinarmas
                    </span>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="wishlistModalLabel">Your Wishlist</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @foreach($wishlists as $wishlist)
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="card border" style="border-radius: 15px; border-width: 10px;">
                                @foreach ($wishlist->carUnit->photos->take(1) as $photo)
                                <a href="#" class="car-sale-link" data-id="{{ $wishlist->carUnit->id }}" data-name="{{ $wishlist->carUnit->name }}">
                                    <img src="{{ asset('storage/'.$photo->file_path) }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px 10px 10px 10px;" alt="Car Photo">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-5">
							<div class="card border" style="border-radius: 15px; border-width: 10px;">
								<div class="card-body" style="overflow-wrap: break-word;"> <!-- Tambahkan style untuk overflow-wrap -->
									<h4 class="card-title" style="border-top-left-radius: 15px; border-top-right-radius: 15px; font-weight: bold;"> <!-- Tambahkan style untuk tebal -->
										<a href="#" class="car-sale-link" data-id="{{ $wishlist->carUnit->id }}" data-name="{{ $wishlist->carUnit->name }}" style="text-decoration: none; color: inherit; transition: color 0.3s;">{{ $wishlist->carUnit->name }}</a>
									</h4>
									<p class="text-muted fw-normal"> {{$wishlist->carUnit->brand->name}} - {{$wishlist->carUnit->year}} - {{$wishlist->carUnit->transmission}} - {{$wishlist->carUnit->fuel_type}}</p>
									<p style="color: black;"><b>Rp. {{ number_format($wishlist->carUnit->price, 0, ',', '.') }}</b></p> <!-- Ubah ke format rupiah -->
									<!-- Tambahkan tombol trash dan eye -->
									<div style="display: flex; align-items: center; margin-top: 5px;"> <!-- Mengurangi margin-top -->
										<a href="#" class="btn btn-danger" style="margin-right: 15px;"><i class="fa fa-trash"></i></a> <!-- Mengurangi margin-right -->
										<a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
