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
    <style>
        .header-ctn {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .header-ctn div {
            text-align: center;
        }

        .header-ctn a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .header-ctn i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header-ctn .qty {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        .header-ctn {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .header-ctn div {
            text-align: center;
        }

        .header-ctn a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .header-ctn i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header-ctn .qty {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .status-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
            padding: 5px 10px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .status-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
            padding: 5px 10px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .status-badge.approved {
            background-color: #00d885;
            color: white;
        }

        .status-badge.pending {
            background-color: #888888;
            color: white;
        }

        .status-badge.rejected {
            background-color: #e72424;
            color: white;
        }

        .car-photo {
        width: 100%;
        height: 200px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
        object-fit: cover;
        border-radius: 10px 10px 10px 10px;
    }
        </style>

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
                    <li><a href="#" class="user-profile-link"><i class="fa fa-user-o"></i> {{ Auth::user()->name }}</a></li>
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
                        <!-- <div>
                            <a href="#" id="jadwalLink">
                                <i class="fa fa-calendar"></i>
                                <span>Jadwal Anda</span>
                            </a>
                        </div> -->
                        <!-- <div>
                            <a href="#" data-toggle="modal" data-target="#mobilTitipanModal">
                                <i class="fa fa-car"></i>
                                <span>Mobil Titipan</span>
                                <div class="qty">{{ $totalTitipan }}</div>
                            </a>
                        </div> -->
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
                <div class="col-md-12 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Tentang Kami</h3>
                        <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selamat datang di Showroom Mobil Bekas Sinarmas Jember, tempat terbaik untuk menemukan mobil bekas berkualitas tinggi dengan harga kompetitif. Berlokasi di jantung kota Jember, kami berkomitmen untuk memberikan solusi mobil bekas terbaik dengan mengutamakan kepuasan pelanggan. Tim kami yang berpengalaman siap membantu Anda menemukan mobil yang sesuai dengan kebutuhan dan anggaran Anda. Setiap mobil yang kami jual telah melalui inspeksi ketat untuk memastikan standar kualitas yang tinggi. Selain penjualan, kami juga menawarkan layanan pembiayaan, asuransi, dan tukar tambah dengan opsi pembiayaan yang fleksibel melalui kemitraan dengan berbagai lembaga keuangan. Di Showroom Mobil Bekas Sinarmas Jember, kepercayaan dan kepuasan pelanggan adalah prioritas utama kami. Kunjungi showroom kami dan temukan mengapa kami menjadi pilihan utama untuk mobil bekas di Jember. Terima kasih telah memilih Showroom Mobil Bekas Sinarmas Jember. Kami berharap dapat melayani Anda dan membantu menemukan mobil impian Anda.</p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Kontak Kami</h3>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-phone"></i>0851-5658-5108</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>showroom.sinarmas@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="footer">
                        <h3 class="footer-title">Lokasi Kami</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="color: white;">Jl. PB Sudirman No. 14, Kec. Patrang, Jember (Sabtu-Minggu, 16.00-22.00 WIB)</h4>
                                <div id="map1" style="width: 100%; height: 300px; margin-bottom: 15px;">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.4293135858644!2d113.70464951433319!3d-8.183419794119742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b0e0a5e23f%3A0xa1a9b9e18c8d56c5!2sJl.%20PB%20Sudirman%20No.14%2C%20Jember!5e0!3m2!1sen!2sid!4v1624440174141!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 style="color: white;">Jl. Jayanegara, Kec. Kaliwates, Jember (Sanin-Jumat, 08.00-17.00 WIB)</h4>
                                <div id="map2" style="width: 100%; height: 300px;">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.4293135858644!2d113.70464951433319!3d-8.183419794119742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b0e0a5e23f%3A0xa1a9b9e18c8d56c5!2sJl.%20Jayanegara%2C%20Kaliwates%2C%20Jember!5e0!3m2!1sen!2sid!4v1624440174141!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="bottom-footer" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
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
                            <div class="col-xs-6">
                            <div class="card border" style="border-radius: 15px; border-width: 10px;">
                                @foreach ($wishlist->carUnit->photos->take(1) as $photo)
                                <a href="#" class="car-sale-link" data-id="{{ $wishlist->carUnit->id }}" data-name="{{ $wishlist->carUnit->name }}">
                                    <img src="{{ asset('storage/'.$photo->file_path) }}" class="img-responsive car-photo" alt="Car Photo">
                                </a>
                                @endforeach
                            </div>
                            </div>
                            <div class="col-xs-6">
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
									    	<a href="{{ route('car.detail', ['id' => $wishlist->carUnit->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
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
    <div class="modal fade" id="mobilTitipanModal" tabindex="-1" role="dialog" aria-labelledby="mobilTitipanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="mobilTitipanModalLabel">Mobil Titipan Saya</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @foreach($carUnitsTitipan as $carUnit)
                    <div class="row" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 10px;">
                        <div class="col-xs-6">
                            <div class="card border" style="border-radius: 15px; border-width: 10px;">
                                @foreach ($carUnit->photos->take(1) as $photo)
                                <a href="#" class="car-sale-link" data-id="{{ $carUnit->id }}" data-name="{{ $carUnit->name }}">
                                    <img src="{{ asset('storage/'.$photo->file_path) }}" class="img-responsive car-photo" alt="Car Photo">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="card border" style="border-radius: 15px; border-width: 10px;">
                                <div class="card-body" style="overflow-wrap: break-word;">
                                    <span class="status-badge {{ $carUnit->type_status == 'Disetujui' ? 'approved' : ($carUnit->type_status == 'Menunggu Verifikasi' ? 'pending' : 'rejected') }}" style="margin-bottom: 10px;">
                                        {{ $carUnit->type_status }}
                                    </span>
                                    <h4 class="card-title" style="border-top-left-radius: 15px; border-top-right-radius: 15px; font-weight: bold; margin-top: 10px;">
                                        <a href="#" class="car-sale-link" data-id="{{ $carUnit->id }}" data-name="{{ $carUnit->name }}" style="text-decoration: none; color: inherit; transition: color 0.3s;">{{ $carUnit->name }}</a>
                                    </h4>
                                    <p class="text-muted fw-normal"> {{$carUnit->brand->name}} - {{$carUnit->year}} - {{$carUnit->transmission}} - {{$carUnit->fuel_type}}</p>
                                    <p style="color: black;"><b>Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</b></p>
                                    <div style="display: flex; align-items: center; margin-top: 5px;">
                                        <a href="#" class="btn btn-danger" style="margin-right: 15px;"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('car.detail', ['id' => $carUnit->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script>
    $(document).ready(function() {
        $('.user-profile-link').on('click', function(event) {
            @auth
            var userName = '{{ Auth::user()->name }}';
            var userEmail = '{{ Auth::user()->email }}';
            var userPhone = '{{ Auth::user()->phone }}';
            var userAddress = '{{ Auth::user()->address }}';
            @endauth
            Swal.fire({
                title: 'Your Profile',
                html: `
                    <div>
                        <label for="swal-input-name"><i class="fa fa-user"></i>Nama</label>
                        <input type="text" id="swal-input-name" class="swal2-input" placeholder="Name" value="${userName}">
                    </div>
                    <div>
                        <label for="swal-input-email"><i class="fa fa-envelope"></i>Email</label>
                        <input type="email" id="swal-input-email" class="swal2-input" placeholder="Email" value="${userEmail}" readonly>
                    </div>
                    <div>
                        <label for="swal-input-phone"><i class="fa fa-phone"></i>No.HP</label>
                        <input type="text" id="swal-input-phone" class="swal2-input" placeholder="Phone" value="${userPhone}">
                    </div>
                    <div>
                        <label for="swal-input-address"><i class="fa fa-home"></i>Alamat</label>
                        <input type="text" id="swal-input-address" class="swal2-input" placeholder="Address" value="${userAddress}">
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    return {
                        name: document.getElementById('swal-input-name').value,
                        phone: document.getElementById('swal-input-phone').value,
                        address: document.getElementById('swal-input-address').value                      
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("profile.update") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: result.value.name,
                            phone: result.value.phone,
                            address: result.value.address
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Profil Berhasil Diupdate',
                                text: 'Profil anda berhasil dirubah.'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan dalam melakukan update profil.'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@yield('js')
</body>
</html>
