<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('images/favicon.ico')}}">

	<title>BJM - Berkah Jaya Motor Mobilindo</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('user/css/vendors_css.css')}}">

	<!-- Style-->
	<link rel="stylesheet" href="{{asset('user/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('user/css/skin_color.css')}}">

</head>

<body class="theme-primary">

	<header class="top-bar text-dark">
		<div class="topbar">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-lg-6 col-12 xs-mb-10">
						<div class="topbar-call text-center text-lg-end topbar-right">
							<ul class="list-inline d-lg-flex justify-content-end">
								@if(!Auth::check())
								<li class="me-10 ps-10"><a href="{{route('auth.register')}}"><i class="text-dark fa fa-user d-md-inline-block d-none"></i> Daftar</a></li>
								<li class="me-10 ps-10"><a href="{{route('auth.login')}}"><i class="text-dark fa fa-sign-in d-md-inline-block d-none"></i> Masuk</a></li>
								@endif
								@if(Auth::check())
								<li class="nav-item dropdown me-10 ps-10">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										<img alt="image" src="{{asset('images/avatar/avatar-7.png')}}" class="rounded-circle mr-1" style="width: 30px; height: 25px;">
										<div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('customer_profile') }}"><i class="fa fa-user"></i> Edit
												Profile</a></li>
										<li><a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i>
												Logout</a></li>
									</ul>
								</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<nav hidden class="nav-dark nav-transparent">
			<div class="nav-header">
				<a href="{{url('/')}}" style="padding: 5px;">
					<!-- <img src="../images/logo-light-text2.png" alt="" /> -->
					<h3 class="text-primary fw-bold mb-0">BJM<span class="text-dark"> Mobilindo</span> </h3>
				</a>
				<button class="toggle-bar">
					<span class="ti-menu"></span>
				</button>
			</div>
			<ul class="menu">
				<li>
					<a href="{{url('/')}}">Beranda</a>
				</li>
				<li>
					<a href="{{route('tentang.index')}}">Tentang</a>
				</li>
				<li>
					<a href="{{route('mobil.index')}}">Mobil</a>
				</li>
				@if(Auth::check())
				<li>
					<a href="{{route('cekPesanan.index')}}">Cek Pesanan</a>
				</li>
				@endif
			</ul>
			<ul class="attributes">
				@if(Auth::check())
				<li class="megamenu" data-width="270">
					<a href="{{route('keranjang')}}"><span class="ti-shopping-cart"></span></a>
					<div class="megamenu-content megamenu-cart">
						<!-- Start Shopping Cart -->
						<div class="cart-header">
							<div class="total-price">
								Total: <span>Rp.{{ number_format($pesanan->sum(function($row) { return $row->harga_produk; }), 0, ',', '.') }}</span>
							</div>
							<i class="ti-shopping-cart"></i>
							<span class="badge">{{ $pesanan->count() }}</span>
						</div>
						<div class="cart-body">
							<ul>
								@foreach($pesanan as $row)
								<li>
									<img src="{{ Storage::url($row->image_produk) }}" alt="">
									<h5 class="title">{{ $row->nama_produk }}</h5>
									<span class="qty">Quantity: {{ $row->jumlah_produk }}</span>
									<span class="price-st">Rp.{{ number_format($row->harga_produk, 0, ',', '.') }}</span>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="cart-footer">
							<a href="{{route('keranjang')}}">Checkout</a>
						</div>
						<!-- End Shopping Cart -->
					</div>
				</li>
				@endif
			</ul>

			<div class="wrap-search-fullscreen">
				<div class="container">
					<button class="close-search"><span class="ti-close"></span></button>
					<input type="text" placeholder="Search..." />
				</div>
			</div>
		</nav>
	</header>


	<section class="bg-img pt-150 pb-100" data-overlay-light="3">
		<div class="container">
			<div class="blog-post">
				<div class="entry-image clearfix">
					<div class="owl-carousel bottom-dots-center owl-theme" data-nav-dots="true" data-autoplay="true" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
						<div class="item">
							<img class="img-fluid rounded" src="{{asset('images/bg2.png')}}" alt="">
						</div>
						<div class="item">
							<img class="img-fluid rounded" src="{{asset('images/bg6.png')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class=" bg-white" data-aos="fade-up">
		<div class="container">
			<div class="row mt-30">
				<div class="col-12">
					<ul class="nav nav-tabs justify-content-center bb-0 mb-10" role="tablist">
						<li class="nav-item">
							<a class="nav-link {{ $type == 'terbaru' ? 'active' : '' }}" href="{{ route('filterType', 'terbaru') }}" role="tab">Terbaru</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ $type == 'automatic' ? 'active' : '' }}" href="{{ route('filterType', 'automatic') }}" role="tab">Automatic</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ $type == 'manual' ? 'active' : '' }}" href="{{ route('filterType', 'manual') }}" role="tab">Manual</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane {{ $type == 'terbaru' ? 'active' : '' }}" id="tab8" role="tabpanel">
							<div class="px-15 pt-15">
								<div class="row">
									@foreach($data as $row)
									<div class="col-lg-3 col-md-6 col-12">
										<div class="card">
											<a href="{{ url('produk/detail/' . $row->id) }}">
												<img src="{{ asset('storage/' . $row->gambar1) }}" alt="user" style="width: 100%; height: 200px; object-fit: cover;">
											</a>
											<div class="position-absolute r-10 t-10">
												<button type="button" class="waves-effect waves-circle btn btn-circle btn-dark btn-xs me-5"><i class="fa fa-heart-o"></i></button>
											</div>
											<div class="card-body">
												<h4 class="card-title">{{ $row->judul }}</h4>
												<h5 class="fw-bold">Rp {{ number_format($row->harga, 0, ',', '.') }}</h5>
												<div class="d-flex justify-content-between">
													<div class="d-flex align-items-center">
														<i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->kilometer }}</span>
													</div>
													<div class="d-flex align-items-center">
														<i class="ti-car me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->transmisi }}</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="tab-pane {{ $type == 'automatic' ? 'active' : '' }}" id="tab8" role="tabpanel">
							<div class="px-15 pt-15">
								<div class="row">
									@foreach($data as $row)
									<div class="col-lg-3 col-md-6 col-12">
										<div class="card">
											<a href="{{ url('produk/detail/' . $row->id) }}">
												<img src="{{ asset('storage/' . $row->gambar1) }}" alt="user" style="width: 100%; height: 200px; object-fit: cover;">
											</a>
											<div class="position-absolute r-10 t-10">
												<button type="button" class="waves-effect waves-circle btn btn-circle btn-dark btn-xs me-5"><i class="fa fa-heart-o"></i></button>
											</div>
											<div class="card-body">
												<h4 class="card-title">{{ $row->judul }}</h4>
												<h5 class="fw-bold">Rp {{ number_format($row->harga, 0, ',', '.') }}</h5>
												<div class="d-flex justify-content-between">
													<div class="d-flex align-items-center">
														<i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->kilometer }}</span>
													</div>
													<div class="d-flex align-items-center">
														<i class="ti-car me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->transmisi }}</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="tab-pane {{ $type == 'manual' ? 'active' : '' }}" id="tab8" role="tabpanel">
							<div class="px-15 pt-15">
								<div class="row">
									@foreach($data as $row)
									<div class="col-lg-3 col-md-6 col-12">
										<div class="card">
											<a href="{{ url('produk/detail/' . $row->id) }}">
												<img src="{{ asset('storage/' . $row->gambar1) }}" alt="user" style="width: 100%; height: 200px; object-fit: cover;">
											</a>
											<div class="position-absolute r-10 t-10">
												<button type="button" class="waves-effect waves-circle btn btn-circle btn-dark btn-xs me-5"><i class="fa fa-heart-o"></i></button>
											</div>
											<div class="card-body">
												<h4 class="card-title">{{ $row->judul }}</h4>
												<h5 class="fw-bold">Rp {{ number_format($row->harga, 0, ',', '.') }}</h5>
												<div class="d-flex justify-content-between">
													<div class="d-flex align-items-center">
														<i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->kilometer }}</span>
													</div>
													<div class="d-flex align-items-center">
														<i class="ti-car me-2" style="font-size: 1.5em;"></i>
														<span>{{ $row->transmisi }}</span>
													</div>
												</div>
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
		</div>
	</section>

	<section class="py-50" id="mobil">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<div class="side-block px-20 py-20 bg-white cust-accordion shop-page">
						<div class="widget clearfix">
							<div class="widget">
								<h4 class="pb-15 mb-25 bb-1">Filter Pencarian</h4>
								<h4 class="pb-15 mb-25 bb-1">Brand</h4>
								<ul class="list-unstyled">
									<li>
										<input type="checkbox" id="basic_checkbox_1" class="filled-in" value="Toyota" onchange="updateView2()">
										<label for="basic_checkbox_1" class="d-flex justify-content-between align-items-center form-label">
											Toyota
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_2" class="filled-in" value="Daihatsu" onchange="updateView2()">
										<label for="basic_checkbox_2" class="d-flex justify-content-between align-items-center form-label">
											Daihatsu
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_3" class="filled-in" value="Datsun" onchange="updateView2()">
										<label for="basic_checkbox_3" class="d-flex justify-content-between align-items-center form-label">
											Datsun
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_4" class="filled-in" value="Ford" onchange="updateView2()">
										<label for="basic_checkbox_4" class="d-flex justify-content-between align-items-center form-label">
											Ford
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_5" class="filled-in" value="Hino" onchange="updateView2()">
										<label for="basic_checkbox_5" class="d-flex justify-content-between align-items-center form-label">
											Hino
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_6" class="filled-in" value="Honda" onchange="updateView2()">
										<label for="basic_checkbox_6" class="d-flex justify-content-between align-items-center form-label">
											Honda
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_7" class="filled-in" value="Hyundai" onchange="updateView2()">
										<label for="basic_checkbox_7" class="d-flex justify-content-between align-items-center form-label">
											Hyundai
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_8" class="filled-in" value="Isuzu" onchange="updateView2()">
										<label for="basic_checkbox_8" class="d-flex justify-content-between align-items-center form-label">
											Isuzu
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_9" class="filled-in" value="Jeep" onchange="updateView2()">
										<label for="basic_checkbox_9" class="d-flex justify-content-between align-items-center form-label">
											Jeep
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_10" class="filled-in" value="Mazda" onchange="updateView2()">
										<label for="basic_checkbox_10" class="d-flex justify-content-between align-items-center form-label">
											Mazda
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_11" class="filled-in" value="Kia" onchange="updateView2()">
										<label for="basic_checkbox_11" class="d-flex justify-content-between align-items-center form-label">
											Kia
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_12" class="filled-in" value="Mercedes" onchange="updateView2()">
										<label for="basic_checkbox_12" class="d-flex justify-content-between align-items-center form-label">
											Mercedes
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_13" class="filled-in" value="Mitsubishi" onchange="updateView2()">
										<label for="basic_checkbox_13" class="d-flex justify-content-between align-items-center form-label">
											Mitsubishi
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_14" class="filled-in" value="Nissan" onchange="updateView2()">
										<label for="basic_checkbox_14" class="d-flex justify-content-between align-items-center form-label">
											Nissan
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_15" class="filled-in" value="Suzuki" onchange="updateView2()">
										<label for="basic_checkbox_15" class="d-flex justify-content-between align-items-center form-label">
											Suzuki
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_16" class="filled-in" value="Wuling" onchange="updateView2()">
										<label for="basic_checkbox_16" class="d-flex justify-content-between align-items-center form-label">
											Wuling
										</label>
									</li>
								</ul>
							</div>
						</div>
						<script>
							function updateView2() {
								// Ambil nilai checkbox yang dipilih
								const toyota = document.getElementById('basic_checkbox_1').checked;
								const daihatsu = document.getElementById('basic_checkbox_2').checked;
								const datsun = document.getElementById('basic_checkbox_3').checked;
								const ford = document.getElementById('basic_checkbox_4').checked;
								const hino = document.getElementById('basic_checkbox_5').checked;
								const honda = document.getElementById('basic_checkbox_6').checked;
								const hyundai = document.getElementById('basic_checkbox_7').checked;
								const isuzu = document.getElementById('basic_checkbox_8').checked;
								const jeep = document.getElementById('basic_checkbox_9').checked;
								const mazda = document.getElementById('basic_checkbox_10').checked;
								const kia = document.getElementById('basic_checkbox_11').checked;
								const mercedes = document.getElementById('basic_checkbox_12').checked;
								const mitsubishi = document.getElementById('basic_checkbox_13').checked;
								const nissan = document.getElementById('basic_checkbox_14').checked;
								const suzuki = document.getElementById('basic_checkbox_15').checked;
								const wuling = document.getElementById('basic_checkbox_16').checked;
								// Kirim request ke server untuk mendapatkan data produk berdasarkan filter tahun
								fetch('/filter-merk-home', {
										method: 'POST',
										headers: {
											'Content-Type': 'application/json',
											'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
										},
										body: JSON.stringify({
											filters: [
												toyota ? 'Toyota' : '',
												daihatsu ? 'Daihatsu' : '',
												datsun ? 'Datsun' : '',
												ford ? 'Ford' : '',
												hino ? 'Hino' : '',
												honda ? 'Honda' : '',
												hyundai ? 'Hyundai' : '',
												isuzu ? 'Isuzu' : '',
												jeep ? 'Jeep' : '',
												kia ? 'Kia' : '',
												mercedes ? 'Mercedes' : '',
												mitsubishi ? 'Mitsubishi' : '',
												nissan ? 'Nissan' : '',
												suzuki ? 'Suzuki' : '',
												wuling ? 'Wuling' : '',
											].filter(Boolean)
										})
									})
									.then(response => response.json())
									.then(data => {
										// Perbarui tampilan dengan data yang diterima
										const productList1 = document.getElementById('product-list');
										productList1.innerHTML = ''; // Hapus konten lama

										data.forEach(product => {
											const productElement = document.createElement('div');
											productElement.className = 'col-12 col-xl-4 col-md-6 mb-4'; // Tambahkan margin bottom untuk jarak antar produk
											productElement.innerHTML = `
                    <div class="box box-default shadow" style="border-radius: 10px;"> <!-- Tambahkan shadow untuk efek bayangan -->
                        <div class="fx-card-item">
                            <div class="fx-card-avatar fx-overlay-1 mb-0">
                                <img src="/storage/${product.gambar1}" alt="user" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;"> <!-- Tambahkan border-radius untuk sudut yang lebih bulat -->
                                <div class="fx-overlay scrl-up">
                                    <ul class="fx-info">
                                        <li><a class="btn btn-outline image-popup-vertical-fit" href="/storage/${product.gambar1}" style="background-color: #dc3545; color: white;">Lihat Gambar</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                        <li><a class="btn btn-outline" href="/produk/detail/${product.id}" style="background-color: #dc3545; color: white;">Detail Mobil</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                    </ul>
                                </div>
                            </div>
                            <div class="fx-card-content text-start mb-0">
                                <div class="product-text">
                                    <h4 class="box-title mb-0" style="font-weight: bold;">${product.judul}</h4> <!-- Membuat judul lebih tebal -->
                                    <h4 class="pro-price text-blue" style="font-size: 18px;">Rp ${product.harga.toLocaleString('id-ID')}</h4> <!-- Ubah ukuran font untuk harga -->
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.kilometer}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="ti-car me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.transmisi}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
											productList1.appendChild(productElement);
										});
									})
									.catch(error => console.error('Error:', error));
							}
						</script>
						<div class="widget clearfix">
							<div class="widget">
								<h4 class="pb-15 mb-25 bb-1">Tahun</h4>
								<ul class="list-unstyled">
									<li>
										<input type="checkbox" id="basic_checkbox_17" class="filled-in" value="2024" onchange="updateView1()">
										<label for="basic_checkbox_17" class="d-flex justify-content-between align-items-center form-label">
											2024
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_18" class="filled-in" value="2023" onchange="updateView1()">
										<label for="basic_checkbox_18" class="d-flex justify-content-between align-items-center form-label">
											2023
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_19" class="filled-in" value="2022" onchange="updateView1()">
										<label for="basic_checkbox_19" class="d-flex justify-content-between align-items-center form-label">
											2022
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_20" class="filled-in" value="2021" onchange="updateView1()">
										<label for="basic_checkbox_20" class="d-flex justify-content-between align-items-center form-label">
											2021
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_21" class="filled-in" value="2020" onchange="updateView1()">
										<label for="basic_checkbox_21" class="d-flex justify-content-between align-items-center form-label">
											2020
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_22" class="filled-in" value="2019" onchange="updateView1()">
										<label for="basic_checkbox_22" class="d-flex justify-content-between align-items-center form-label">
											2019
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_23" class="filled-in" value="2018" onchange="updateView1()">
										<label for="basic_checkbox_23" class="d-flex justify-content-between align-items-center form-label">
											2018
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_24" class="filled-in" value="2017" onchange="updateView1()">
										<label for="basic_checkbox_24" class="d-flex justify-content-between align-items-center form-label">
											< 2017 </label>
									</li>
								</ul>
							</div>
						</div>
						<script>
							function updateView1() {
								// Ambil nilai checkbox yang dipilih
								const tahun2024 = document.getElementById('basic_checkbox_17').checked;
								const tahun2023 = document.getElementById('basic_checkbox_18').checked;
								const tahun2022 = document.getElementById('basic_checkbox_19').checked;
								const tahun2021 = document.getElementById('basic_checkbox_20').checked;
								const tahun2020 = document.getElementById('basic_checkbox_21').checked;
								const tahun2019 = document.getElementById('basic_checkbox_22').checked;
								const tahun2018 = document.getElementById('basic_checkbox_23').checked;
								const tahun2017 = document.getElementById('basic_checkbox_24').checked;
								// Kirim request ke server untuk mendapatkan data produk berdasarkan filter tahun
								fetch('/filter-tahun-home', {
										method: 'POST',
										headers: {
											'Content-Type': 'application/json',
											'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
										},
										body: JSON.stringify({
											filters: [
												tahun2024 ? '2024' : '',
												tahun2023 ? '2023' : '',
												tahun2022 ? '2022' : '',
												tahun2021 ? '2021' : '',
												tahun2020 ? '2020' : '',
												tahun2019 ? '2019' : '',
												tahun2018 ? '2018' : '',
												tahun2017 ? '2017' : '',
											].filter(Boolean)
										})
									})
									.then(response => response.json())
									.then(data => {
										// Perbarui tampilan dengan data yang diterima
										const productList1 = document.getElementById('product-list');
										productList1.innerHTML = ''; // Hapus konten lama

										data.forEach(product => {
											const productElement = document.createElement('div');
											productElement.className = 'col-12 col-xl-4 col-md-6 mb-4'; // Tambahkan margin bottom untuk jarak antar produk
											productElement.innerHTML = `
                    <div class="box box-default shadow" style="border-radius: 10px;"> <!-- Tambahkan shadow untuk efek bayangan -->
                        <div class="fx-card-item">
                            <div class="fx-card-avatar fx-overlay-1 mb-0">
                                <img src="/storage/${product.gambar1}" alt="user" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;"> <!-- Tambahkan border-radius untuk sudut yang lebih bulat -->
                                <div class="fx-overlay scrl-up">
                                    <ul class="fx-info">
                                        <li><a class="btn btn-outline image-popup-vertical-fit" href="/storage/${product.gambar1}" style="background-color: #dc3545; color: white;">Lihat Gambar</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                        <li><a class="btn btn-outline" href="/produk/detail/${product.id}" style="background-color: #dc3545; color: white;">Detail Mobil</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                    </ul>
                                </div>
                            </div>
                            <div class="fx-card-content text-start mb-0">
                                <div class="product-text">
                                    <h4 class="box-title mb-0" style="font-weight: bold;">${product.judul}</h4> <!-- Membuat judul lebih tebal -->
                                    <h4 class="pro-price text-blue" style="font-size: 18px;">Rp ${product.harga.toLocaleString('id-ID')}</h4> <!-- Ubah ukuran font untuk harga -->
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.kilometer}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="ti-car me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.transmisi}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
											productList1.appendChild(productElement);
										});
									})
									.catch(error => console.error('Error:', error));
							}
						</script>
						<div class="widget clearfix">
							<div class="widget">
								<h4 class="pb-15 mb-25 bb-1">Transmisi</h4>
								<ul class="list-unstyled">
									<li>
										<input type="checkbox" id="basic_checkbox_25" class="filled-in" value="Automatic" onchange="updateView()">
										<label for="basic_checkbox_25" class="d-flex justify-content-between align-items-center form-label">
											Automatic
										</label>
									</li>
									<li>
										<input type="checkbox" id="basic_checkbox_26" class="filled-in" value="Manual" onchange="updateView()">
										<label for="basic_checkbox_26" class="d-flex justify-content-between align-items-center form-label">
											Manual
										</label>
									</li>
								</ul>
							</div>
						</div>
						<script>
							function updateView() {
								// Ambil nilai checkbox yang dipilih
								const automatic = document.getElementById('basic_checkbox_25').checked;
								const manual = document.getElementById('basic_checkbox_26').checked;

								// Kirim request ke server untuk mendapatkan data produk berdasarkan filter transmisi
								fetch('/filter-transmisi-home', {
										method: 'POST',
										headers: {
											'Content-Type': 'application/json',
											'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
										},
										body: JSON.stringify({
											filters: [automatic ? 'Automatic' : '', manual ? 'Manual' : ''].filter(Boolean)
										})
									})
									.then(response => response.json())
									.then(data => {
										// Perbarui tampilan dengan data yang diterima
										const productList = document.getElementById('product-list');
										productList.innerHTML = ''; // Hapus konten lama

										data.forEach(product => {
											const productElement = document.createElement('div');
											productElement.className = 'col-12 col-xl-4 col-md-6 mb-4'; // Tambahkan margin bottom untuk jarak antar produk
											productElement.innerHTML = `
                    <div class="box box-default shadow" style="border-radius: 10px;"> <!-- Tambahkan shadow untuk efek bayangan -->
                        <div class="fx-card-item">
                            <div class="fx-card-avatar fx-overlay-1 mb-0">
                                <img src="/storage/${product.gambar1}" alt="user" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;"> <!-- Tambahkan border-radius untuk sudut yang lebih bulat -->
                                <div class="fx-overlay scrl-up">
                                    <ul class="fx-info">
                                        <li><a class="btn btn-outline image-popup-vertical-fit" href="/storage/${product.gambar1}" style="background-color: #dc3545; color: white;">Lihat Gambar</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                        <li><a class="btn btn-outline" href="/produk/detail/${product.id}" style="background-color: #dc3545; color: white;">Detail Mobil</a></li> <!-- Ubah warna tombol untuk lebih menarik -->
                                    </ul>
                                </div>
                            </div>
                            <div class="fx-card-content text-start mb-0">
                                <div class="product-text">
                                    <h4 class="box-title mb-0" style="font-weight: bold;">${product.judul}</h4> <!-- Membuat judul lebih tebal -->
                                    <h4 class="pro-price text-blue" style="font-size: 18px;">Rp ${product.harga.toLocaleString('id-ID')}</h4> <!-- Ubah ukuran font untuk harga -->
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.kilometer}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="ti-car me-2" style="font-size: 1.5em;"></i>
                                            <span>${product.transmisi}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
											productList.appendChild(productElement);
										});
									})
									.catch(error => console.error('Error:', error));
							}
						</script>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="row align-items-center mb-30">
						<div class="col-6">
							<span>menampilkan 1-12 of 30 produk</span>
						</div>
						<div class="col-6 text-end">
							<select id="filter" class="form-select max-w-170 d-inline-block">
								<option data-display="Select">Urutkan</option>
								<option value="tahun_baru_lama">Tahun Baru - Lama</option>
								<option value="tahun_lama_baru">Tahun Lama - Baru</option>
								<option value="km_terendah_tertinggi">Kilometer Terendah - Tertinggi</option>
								<option value="km_tertinggi_terendah">Kilometer Tertinggi - Terendah</option>
							</select>
						</div>
						<script>
							document.getElementById('filter').addEventListener('change', function() {
								var selectedValue = this.value;
								window.location.href = '/filter-km-home?filter=' + selectedValue;
							});
						</script>
					</div>
					<div class="row fx-element-overlay" id="product-list">
						@if(count($data) > 0)
						@foreach($data as $row)
						<div class="col-12 col-xl-4 col-md-6">
							<div class="box box-default">
								<div class="fx-card-item">
									<div class="fx-card-avatar fx-overlay-1 mb-0">
										<img src="{{ Storage::url($row->gambar1) }}" alt="user" style="width: 100%; height: 200px; object-fit: cover;">
										<div class="fx-overlay scrl-up">
											<ul class="fx-info">
												<li><a class="btn btn-outline image-popup-vertical-fit" href="{{ Storage::url($row->gambar1) }}" width="10%" height="20%">Lihat Gambar</a></li>
												<li><a class="btn btn-outline" href="{{ url('produk/detail/' . $row->id) }}">Detail Mobil</a></li>
											</ul>
										</div>
									</div>
									<div class="fx-card-content text-start mb-0">
										<div class="product-text">
											<h4 class="box-title mb-0">{{ $row->judul }}</h4>
											<ul class="cours-star mb-5">

											</ul>
											<h4 class="fw-bold">Rp {{ number_format($row->harga, 0, ',', '.') }}</h4>
											<br>
											<div class="d-flex justify-content-between">
												<div class="d-flex align-items-center">
													<i class="ti-dashboard me-2" style="font-size: 1.5em;"></i>
													<span>{{ $row->kilometer }}</span>
												</div>
												<div class="d-flex align-items-center">
													<i class="ti-car me-2" style="font-size: 1.5em;"></i>
													<span>{{ $row->transmisi }}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<tr>
							<td colspan="8" class="text-center">Tidak ada data.</td>
						</tr>
						@endif
					</div>
					<div class="row">
						<div class="col-12">
							<div class="box">
								<div class="box-body">
									<div aria-label="Page navigation example">
										<ul class="pagination mb-0 justify-content-center">
											<li class="page-item"><a class="page-link" href="#">Previous</a></li>
											<li class="page-item"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item"><a class="page-link" href="#">Next</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-50" id="kontak">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-7 col-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2042715.3458415323!2d98.98013135625!3d0.47983009999999554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a9276b4f592b%3A0x679c768096e0950f!2sShowroom%20BJM%20Mobilindo!5e0!3m2!1sid!2sid!4v1719825537959!5m2!1sid!2sid" class="map" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-md-5 col-12 mt-30 mt-md-0">
					<div class="box box-body p-40 bg-dark mb-0">
						<h2 class="box-title text-white">Info Kontak</h2>
						<div class="widget fs-18 my-20 py-20 by-1 border-light">
							<ul class="list list-unstyled text-white-80">
								<li class="ps-40"><i class="ti-location-pin"></i>Arengka 1 No 36 D-E, Jl. Soekarno - Hatta, Sidomulyo Tim., kecamatan Marpoyan, Kota Pekanbaru, Riau 28125</li>
								<li class="ps-40 my-20"><i class="ti-mobile"></i>0852-6552-7838</li>
								<li class="ps-40"><i class="ti-email"></i>info@bjm.com</li>
							</ul>
						</div>
						<h4 class="mb-20">Follow Us</h4>
						<ul class="list-unstyled d-flex gap-items-1">
							<li><a href="https://www.facebook.com/profile.php?id=100063790734707&locale=id_ID" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="footer_three">
		<div class="footer-top bg-dark3 pt-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-12">
						<div class="widget">
							<h4 class="footer-title">Hubungi Kami</h4>
							<hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
							<ul class="list list-unstyled mb-30">
								<li> <i class="fa fa-map-marker"></i> Arengka 1 No 36 D-E, Jl. Soekarno - Hatta, Sidomulyo Tim., kecamatan Marpoyan, Kota Pekanbaru, Riau 28125</li>
								<li> <i class="fa fa-phone"></i> <span>0852-6552-7838</span></li>
								<li> <i class="fa fa-envelope"></i> <span>info@bjm.com </span><br><span>support@bjm.com </span></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-lg-3">
						<div class="widget widget_gallery clearfix">
							<h4 class="footer-title">Our Gallery</h4>
							<hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
							<ul class="list-unstyled">
								<li><img src="{{asset('images/gallery/thumb/20.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/21.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/22.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/23.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/24.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/25.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/26.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/27.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/20.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/20.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/20.jpg')}}" alt=""></li>
								<li><img src="{{asset('images/gallery/thumb/20.jpg')}}" alt=""></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-12">
						<div class="widget">
							<h4 class="footer-title mt-20">Saran & Pertanyaan</h4>
							<hr class="bg-primary mb-4 mt-0 d-inline-block mx-auto w-60">
							<div class="mb-20">
								<form class="" action="" method="post">
									<div class="input-group">
										<input name="email" required="required" class="form-control" placeholder="Email" type="email">
										<button name="submit" value="Submit" type="submit" class="btn btn-primary"> <i class="fa fa-envelope"></i> </button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom bg-dark3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-12 text-md-start text-center"> © 2024 <span class="text-white">BJM-Mobilindo</span> All Rights Reserved.</div>
					<div class="col-md-6 mt-md-0 mt-20">
						<div class="social-icons">
							<ul class="list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
								<li><a href="https://www.facebook.com/profile.php?id=100063790734707&locale=id_ID" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>


	<!-- Vendor JS -->
	<script src="{{asset('user/js/vendors.min.js')}}"></script>
	<!-- Corenav Master JavaScript -->
	<script src="{{asset('user/corenav-master/coreNavigation-1.1.3.js')}}"></script>
	<script src="{{asset('user/js/nav.js')}}"></script>
	<script src="{{asset('assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
	<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


	<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="{{asset('assets/vendor_components/gmaps/gmaps.min.js')}}"></script>
	<script src="{{asset('assets/vendor_components/gmaps/jquery.gmaps.js')}}"></script>


	<!-- EduAdmin front end -->
	<script src="{{asset('user/js/template.js')}}"></script>


</body>

</html>