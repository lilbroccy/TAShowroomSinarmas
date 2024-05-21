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
</style>
@endsection
@section('content')
<div class="section">
	<div class="container">
		@foreach ($categories as $category)
		<div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">{{ $category->name }}</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab{{ $category->id }}-1">All Stock</a></li>
                            <li><a data-toggle="tab" href="#tab{{ $category->id }}-2">Favorites</a></li>
                            <li><a data-toggle="tab" href="#tab{{ $category->id }}-3">New Stock</a></li>
                        </ul>
                    </div>
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
											<!-- <div class="car-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div> -->
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
                </div>
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
            timer: 3000 // 3 detik
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $('.add-to-wishlist').on('click', function() {
            var carUnitId = $(this).data('car-unit-id');

            $.ajax({
                url: '{{ route("wishlist.add") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    car_unit_id: carUnitId
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                    }).then(() => {
                        location.reload(); // Refresh after alert
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Anda harus login untuk menambahkan ke wishlist.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
