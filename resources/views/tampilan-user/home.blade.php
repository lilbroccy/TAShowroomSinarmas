@extends('layout-user.index')
@section('title', 'Halaman Utama')
@section('css')
<link href="{{ asset('user/css/cars-tabs.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- SECTION -->
<!-- <div class="section">
	<div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('user/img/categories/' . $category->category_logo) }}" alt="{{ $category->name }}">
                    </div>
                    <div class="shop-body">
                        <h3>{{ $category->name }}<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
	</div>
</div> -->
<!-- /SECTION -->
<!-- Section Per Category -->
@foreach ($categories as $category)
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
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
						<!-- tab -->
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
												<button class="add-to-wishlist" title="Tambahkan ke Wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp"></span></button>
												<!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> -->
												<button title="Detail Lengkap"><a href="{{ route('car.detail', ['id' => $carUnit->id]) }}"><i class="fa fa-eye text-white"></i></a></button>
												<button class="add-to-check" title="Jadwalkan Cek Unit"><i class="fa fa-calendar"></i> Cek Unit</button>
											</div>
										</div>
									</div>
								@endforeach
							</div>
							<div id="slick-nav-{{ $category->id }}-1" class="cars-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
                </div>
            </div>
            <!-- /section title -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endforeach

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

@endsection
@section('js')
<script src="{{ asset ('user/modal/logout.js') }}"></script>
@endsection