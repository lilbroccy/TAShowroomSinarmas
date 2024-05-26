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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Ajukan Penitipan</button>
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
@endsection

