@extends('layout-user.index')
@section('title', 'Halaman Utama')
@section('css')
<link href="{{ asset('user/css/cars-tabs.css') }}" rel="stylesheet">
<style>
    .faq {
        margin-top: 20px;
    }

    .faq-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .faq-question {
        cursor: pointer;
        margin: 0;
    }

    .faq-answer {
        display: none;
        margin-top: 10px;
    }

    .testimonial-box {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 20px;
        margin: 10px;
        text-align: center;
    }

    .carousel-inner > .item > div {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-control {
            width: 5%;
        }

        .carousel-control .fa-chevron-left,
        .carousel-control .fa-chevron-right {
            font-size: 30px;
            color: #000;
        }

        .carousel-control.left, .carousel-control.right {
            background-image: none;
            top: 65%;
            transform: translateY(-50%);
            width: 5%;
        }

        .carousel-control.left {
            left: -3%;
        }

        .carousel-control.right {
            right: -3%; 
        }

        .carousel-indicators {
            bottom: -15px;
        }
    .carousel-indicators li {
        border-color: #000;
    }

    .carousel-indicators .active {
        background-color: #000;
    }
</style>
@endsection
@section('content')
<div class="section">
    <div class="container">
        @if(isset($cars))
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Search Results</h3>
                        <div class="cars-tabs">
                            <div id="search-results" class="tab-pane active">
                                <div class="cars-slick" data-nav="#slick-nav-search-results">
                                    @forelse ($cars as $car)
                                        <div class="car">
                                            <div class="car-img">
                                                @foreach ($car->photos->take(1) as $photo)
                                                    <img src="{{ asset('storage/'.$photo->file_path) }}" alt="">
                                                @endforeach
                                            </div>
                                            <div class="car-body">
                                                <p class="car-category">{{ $car->brand->name }} - {{ $car->transmission }} - {{ $car->fuel_type }}</p>
                                                <h3 class="car-name"><a href="{{ route('car.detail', ['id' => $car->id]) }}">{{ $car->name }}</a></h3>
                                                <h4 class="car-price">Rp. {{ number_format($car->price, 0, ',', '.') }}</h4>
                                                <div class="car-btns">
                                                    <button class="add-to-wishlist" data-car-unit-id="{{ $car->id }}" title="Tambahkan ke Wishlist">
                                                        <i class="fa fa-heart-o"></i>
                                                        <span class="tooltipp"></span>
                                                    </button>
                                                    <button title="Detail Lengkap"><a href="{{ route('car.detail', ['id' => $car->id]) }}"><i class="fa fa-eye" style="color: white;"></i></a></button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No results found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Default content here -->
            @foreach ($categories as $category)
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">{{ $category->name }}</h3>
                            <div class="cars-tabs">
                                <div id="tab{{ $category->id }}-1" class="tab-pane active">
                                    <div class="cars-slick" data-nav="#slick-nav-{{ $category->id }}-1">
                                        @foreach ($carUnits->where('category_id', $category->id)->where('status', 'Tersedia') as $carUnit)
                                            <div class="car">
                                                <div class="car-img">
                                                    @foreach ($carUnit->photos->take(1) as $photo)
                                                        <img src="{{ asset('storage/'.$photo->file_path) }}" alt="">
                                                    @endforeach
                                                </div>
                                                <div class="car-body">
                                                    <p class="car-category">{{ $carUnit->brand->name }} - {{ $carUnit->transmission }} - {{ $carUnit->fuel_type }}</p>
                                                    <h3 class="car-name"><a href="{{ route('car.detail', ['id' => $carUnit->id]) }}">{{ $carUnit->name }}</a></h3>
                                                    <h4 class="car-price">Rp. {{ number_format($carUnit->price, 0, ',', '.') }}</h4>
                                                    <div class="car-btns">
                                                        <button class="add-to-wishlist" data-car-unit-id="{{ $carUnit->id }}" title="Tambahkan ke Wishlist">
                                                            <i class="fa fa-heart-o"></i>
                                                            <span class="tooltipp"></span>
                                                        </button>
                                                        <button title="Detail Lengkap"><a href="{{ route('car.detail', ['id' => $carUnit->id]) }}"><i class="fa fa-eye" style="color: white;"></i></a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="sell-car-box">
                    <div class="sell-car-content">
                        <div class="sell-car-text">
                            <h2>Ingin Menjual Mobil Anda?</h2>
                            <p>Ajukan penitipan pada kami dan dapatkan penawaran terbaik.</p>
                        </div>
                        <i class="fa fa-car fa-3x sell-car-icon"></i>
                    </div>
                    <div class="text-center">
                        @auth
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Ajukan Penitipan</button>
                        @else
                            <button type="button" class="btn btn-primary" id="login-alert-button">Ajukan Penitipan</button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Pertanyaan yang Sering Diajukan (FAQ)</h3>
                </div>
                <div class="faq">
					<div class="faq-item">
						<h4 class="faq-question">Q: Bagaimana cara membeli mobil di sini? <span style="float: right;">&blacktriangledown;</span></h4>
						<p class="faq-answer" style="display: none;">A: Di sini, Anda dapat melihat unit yang tersedia dan menjadwalkan untuk cek unit/test drive. Untuk melakukan pembelian atau transaksi, Anda dapat langsung datang ke showroom kami.</p>
					</div>
					<div class="faq-item">
						<h4 class="faq-question">Q: Metode pembayaran apa saja yang diterima? <span style="float: right;">&blacktriangledown;</span></h4>
						<p class="faq-answer" style="display: none;">A: Kami menerima berbagai metode pembayaran termasuk transfer bank, kartu kredit, dan opsi pembiayaan. Silakan hubungi tim penjualan kami untuk informasi lebih lanjut.</p>
					</div>
					<div class="faq-item">
						<h4 class="faq-question">Q: Apakah saya bisa tukar tambah mobil lama saya? <span style="float: right;">&blacktriangledown;</span></h4>
						<p class="faq-answer" style="display: none;">A: Ya, kami menawarkan opsi tukar tambah. Silakan hubungi tim kami melalui WhatsApp, bawa mobil Anda untuk evaluasi dan kami akan memberikan penawaran yang kompetitif.</p>
					</div>
					<div class="faq-item">
						<h4 class="faq-question">Q: Apakah ada garansi untuk mobil-mobilnya? <span style="float: right;">&blacktriangledown;</span></h4>
						<p class="faq-answer" style="display: none;">A: Ya, semua mobil kami dilengkapi dengan garansi standar. Detail garansi bervariasi tergantung pada model dan tahun mobil. Silakan periksa halaman detail mobil untuk informasi lebih lanjut.</p>
					</div>
					<div class="faq-item">
						<h4 class="faq-question">Q: Bagaimana cara menghubungi layanan pelanggan? <span style="float: right;">&blacktriangledown;</span></h4>
						<p class="faq-answer" style="display: none;">A: Anda bisa menghubungi tim layanan pelanggan kami melalui WhatsApp kami.</p>
					</div>
                    <div class="faq-item">
                        <h4 class="faq-question">Q: Bagaimana cara mengajukan penitipan mobil saya untuk dijual? <span style="float: right;">&blacktriangledown;</span></h4>
                        <p class="faq-answer" style="display: none;">A: Anda bisa klik Ajukan Penitipan, kemudian isi data mobil Anda. Setelah itu, tim kami akan segera menghubungi Anda untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Testimoni</h3>
                </div>
                <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">\
                    <ol class="carousel-indicators">
                        <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonialCarousel" data-slide-to="1"></li>
                        <li data-target="#testimonialCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Showroom ini benar-benar hebat! Mobil bekas yang saya beli di sini dalam kondisi sangat baik dan pelayanannya luar biasa." - Rizky</p>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Proses pembelian sangat mudah dan cepat. Terima kasih Sinarmas Jember!" - Syahrul</p>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Rekomendasi terbaik untuk showroom mobil bekas. Kualitas mobilnya top!" - Edi Saputro</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Harga yang ditawarkan sangat kompetitif dan layanan pelanggan sangat memuaskan." - Rahmad</p>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Sangat puas dengan mobil yang saya beli di sini. Kondisi mobil sangat bagus." - Akbar Maulana</p>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="testimonial-box">
                                    <p>"Showroom Sinarmas Jember sangat terpercaya. Saya akan kembali lagi untuk pembelian berikutnya." - Daffa Afifi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#testimonialCarousel" data-slide="prev">
                        <span class="fa fa-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#testimonialCarousel" data-slide="next">
                        <span class="fa fa-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Penitipan Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahModalForm">
                @csrf
                <div class="form-group">
                        <label for="name">Nama Mobil:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Brand:</label>
                        <select class="form-control" id="brand_id" name="brand_id" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga:</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun:</label>
                        <input type="text" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Tipe Bahan Bakar:</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" required>
                            <option value="" disabled selected>-- Pilih Opsi --</option>
                            @foreach(\App\Models\CarUnit::FUEL_TYPE_OPTIONS as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transmission">Transmisi:</label>
                        <select class="form-control" id="transmission" name="transmission" required>
                            <option value="" disabled selected>-- Pilih Opsi --</option>
                            @foreach(\App\Models\CarUnit::TRANSMISSION_OPTIONS as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seat">Jumlah Kursi:</label>
                        <input type="text" class="form-control" id="seat" name="seat" required>
                    </div>
                    <div class="form-group">
                        <label for="warranty">Garansi:</label>
                        <input type="text" class="form-control" id="warranty" name="warranty" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Warna:</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                    <div class="form-group">
                        <label for="mileage">Jarak Tempuh:</label>
                        <input type="text" class="form-control" id="mileage" name="mileage" required>
                    </div>
                    <div class="form-group">
                        <label for="engine_cc">CC Mesin:</label>
                        <input type="text" class="form-control" id="engine_cc" name="engine_cc" required>
                    </div>
                    <div class="form-group">
                        <label for="service_book">Buku Service:</label>
                        <select class="form-control" id="service_book" name="service_book" required>
                            <option disabled selected>--Pilih Opsi--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="spare_key">Kunci Cadangan:</label>
                        <select class="form-control" id="spare_key" name="spare_key" required>
                            <option disabled selected>--Pilih Opsi--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_document">Dokumen Unit:</label>
                        <select class="form-control" id="unit_document" name="unit_document" required>
                            <option disabled selected>--Pilih Opsi--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stnk_validity_period">Masa Berlaku STNK:</label>
                        <input type="text" class="form-control" id="stnk_validity_period" name="stnk_validity_period" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photos">Foto Mobil:</label>
                        <input type="file" class="form-control-file" id="photos" name="photos[]" multiple accept="image/*">
                        <small class="form-text text-muted">Pilih beberapa foto (maksimal 12) dengan menekan tombol Ctrl (Cmd untuk Mac) saat memilih.</small>
                    </div>
                    <div class="row mb-3" id="selectedPhotos"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-end" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary float-end ms-2" id="simpanButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('user/modal/logout.js') }}"></script>
<script>
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const isVisible = answer.style.display === 'block';
            document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
            answer.style.display = isVisible ? 'none' : 'block';
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Email berhasil diverifikasi!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
<script src="{{ asset('user/modal/pengajuan.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#login-alert-button').click(function() {
            Swal.fire({
                title: 'Anda harus login terlebih dahulu untuk mengajukan mobil',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.add-to-wishlist').click(function() {
            var carUnitId = $(this).data('car-unit-id');
            
            $.ajax({
                type: "POST",
                url: "{{ route('wishlist.add') }}",
                data: {
                    car_unit_id: carUnitId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload(); // Reload halaman setelah menampilkan pesan sukses
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Anda harus login untuk menambahkan ke wishlist',
                            icon: 'error'
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            icon: 'error'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection

