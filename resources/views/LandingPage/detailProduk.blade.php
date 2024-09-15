<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
                    <h3 class="text-primary fw-bold mb-0">BJM<span class="text-dark"> Mobilindo</span> </h3>
                    <!-- <img src="../images/logo-light-text2.png" alt="" /> -->
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

    <!---page Title --->
    <section class="bg-img pt-50 pb-100" data-overlay-light="3">

    </section>
    <!--Page content -->

    <section class="py-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="box mb-0">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="box box-body b-1 text-center no-shadow">
                                        <img src="{{ asset('storage/' . $produk->gambar1) }}" id="product-image" class="img-fluid" alt="" />
                                    </div>
                                    <div class="pro-photos">
                                        <div class="photos-item item-active">
                                            <img src="{{ asset('storage/' . $produk->gambar2) }}" alt="">
                                        </div>
                                        <div class="photos-item">
                                            <img src="{{ asset('storage/' . $produk->gambar3) }}" alt="">
                                        </div>
                                        <div class="photos-item">
                                            <img src="{{ asset('storage/' . $produk->gambar4) }}" alt="">
                                        </div>
                                        <div class="photos-item">
                                            <img src="{{ asset('storage/' . $produk->gambar5) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="col-md-8 col-sm-6">
                                    <h2 class="box-title mt-0">{{ $produk->judul }}</h2>
                                    <h1 class="fw-bold mb-0 mt-20">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6>Warna</h6>
                                            <div class="input-group">
                                                <span class="badge badge-pill badge-lg badge-default">{{$produk->warna}}</span>
                                            </div>
                                            <h6 class="mt-20">Tipe</h6>
                                            <p class="mb-0">
                                                <span class="badge badge-pill badge-lg badge-default">{{$produk->tipe}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-inline-block">
                                        @if(Auth::check())
                                        <form id="addToCartForm1" action="{{ route('produk.upload-invoice') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $produk->id }}">
                                            <input type="hidden" name="order_id" id="order_id" value="{{$produk->order_id }}">
                                            <input type="hidden" name="invoice" id="invoice" value="{{$produk->invoice }}">
                                            <input type="hidden" name="tipe_produk" id="tipe_produk" value="{{ $produk->tipe }}">
                                            <input type="hidden" name="warna_produk" id="warna_produk" value="{{ $produk->warna }}">
                                            <input type="hidden" name="nama_produk" id="nama_produk" value="{{ $produk->judul }}">
                                            <input type="hidden" name="harga_produk" id="harga_produk" value="{{ $produk->harga }}">
                                            <input type="hidden" name="jumlah_produk" id="jumlah_produk" value="{{ $produk->jumlah_produk}}">
                                            <input type="hidden" name="subtotal_produk" id="subtotal_produk" value="{{ $produk->subtotal_produk}}">
                                            <input type="hidden" name="pajak" id="pajak" value="{{ $produk->pajak}}">
                                            <input type="hidden" name="ongkir" id="ongkir" value="{{ $produk->ongkir}}">
                                            <input type="hidden" name="total_keseluruhan" id="total_keseluruhan" value="{{ $produk->total_keseluruhan}}">
                                            <input type="hidden" name="image_produk" id="image_produk" value="{{ $produk->gambar1}}">

                                        </form>
                                        <a href="#" onclick="submitForm1
                                            ('{{ $produk->id }}',
                                            '{{ $produk->order_id }}',
                                            '{{ $produk->invoice }}',
                                            '{{ $produk->tipe }}',
                                            '{{ $produk->warna }}', 
                                            '{{ $produk->judul }}',
                                            '{{ $produk->harga }}', 
                                            '{{ $produk->jumlah_produk }}',
                                            '{{ $produk->subtotal_produk }}',
                                            '{{ $produk->pajak }}',
                                            '{{ $produk->ongkir }}',
                                            '{{ $produk->total_keseluruhan }}',
                                            '{{ $produk->gambar1 }}', document.getElementById
                                            ('jumlah-{{ $produk->id }}') ? document.getElementById
                                            ('jumlah-{{ $produk->id }}').value : 0)" class="btn btn-success me-10 mb-10">
                                            <i class="mdi mdi-shopping"></i> Beli Sekarang</a>

                                        <script>
                                            function submitForm1(Idproduct, orderID, invoice, tipeProduct, warnaProduct, productName, hargaProduk, jumlahProduk, subtotalProduk, pajak, ongkir, totalKeseluruhan, imageProduct) {
                                                document.getElementById('id').value = Idproduct;
                                                document.getElementById('order_id').value = orderID;
                                                document.getElementById('invoice').value = invoice;
                                                document.getElementById('tipe_produk').value = tipeProduct;
                                                document.getElementById('warna_produk').value = warnaProduct;
                                                document.getElementById('nama_produk').value = productName;
                                                document.getElementById('harga_produk').value = hargaProduk;
                                                document.getElementById('jumlah_produk').value = jumlahProduk;
                                                document.getElementById('subtotal_produk').value = subtotalProduk;
                                                document.getElementById('pajak').value = pajak;
                                                document.getElementById('ongkir').value = ongkir;
                                                document.getElementById('total_keseluruhan').value = totalKeseluruhan;
                                                document.getElementById('image_produk').value = imageProduct;

                                                document.getElementById('addToCartForm1').submit();
                                            }
                                        </script>

                                        <!-- <a href="{{route('chat.index', ['id' => $produk->id])}}" class="btn btn-info me-10 mb-10"><i class="mdi mdi-tooltip-text"></i> Buat Penawaran</a> -->
                                        <a href="https://wa.me/+6285156673874" class="btn btn-info me-10 mb-10"><i class="mdi mdi-tooltip-text"></i> Buat Penawaran</a>

                                        <form id="addToCartForm" action="{{ route('pemesananuser.create') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $produk->id }}">
                                            <input type="hidden" name="order_id" id="order_id" value="{{$produk->order_id }}">
                                            <input type="hidden" name="invoice" id="invoice" value="{{$produk->invoice }}">
                                            <input type="hidden" name="nama_produk" id="nama_produk" value="{{ $produk->judul }}">
                                            <input type="hidden" name="harga_produk" id="harga_produk" value="{{ $produk->harga }}">
                                            <input type="hidden" name="image_produk" id="image_produk" value="{{ $produk->gambar1}}">
                                            <input type="hidden" name="tipe_produk" id="tipe_produk" value="{{ $produk->tipe }}">
                                            <input type="hidden" name="warna_produk" id="warna_produk" value="{{ $produk->warna }}">
                                            <input type="hidden" name="jumlah_produk" id="jumlah_produk" value="{{ $produk->jumlah_produk }}">
                                            <input type="hidden" name="subtotal_produk" id="subtotal_produk" value="{{ $produk->subtotal_produk }}">
                                            <input type="hidden" name="pajak" id="pajak" value="{{ $produk->pajak }}">
                                            <input type="hidden" name="ongkir" id="ongkir" value="{{ $produk->ongkir }}">
                                            <input type="hidden" name="total_keseluruhan" id="total_keseluruhan" value="{{ $produk->total_keseluruhan }}">
                                        </form>

                                        <a href="#" onclick="submitForm
                                            ('{{ $produk->id }}', 
                                            '{{ $produk->order_id }}',
                                            '{{ $produk->invoice }}',
                                            '{{ $produk->judul }}', 
                                            '{{ $produk->harga }}', 
                                            '{{ $produk->gambar1 }}', 
                                            '{{ $produk->tipe }}', 
                                            '{{ $produk->warna }}',
                                            '{{ $produk->jumlah_produk }}',
                                            '{{ $produk->subtotal_produk }}',
                                            '{{ $produk->pajak }}',
                                            '{{ $produk->ongkir }}',
                                            '{{ $produk->total_keseluruhan }}',
                                            document.getElementById
                                            ('jumlah-{{ $produk->id }}') ? document.getElementById
                                            ('jumlah-{{ $produk->id }}').value : 0)" class="btn btn-danger me-10 mb-10">
                                            <i class="mdi mdi-basket"></i>
                                            Tambah ke Keranjang
                                        </a>

                                        <script>
                                            function submitForm(productId, orderID, invoice, productName, hargaProduk, imageProduct, tipeProduct, warnaProduct, jumlah, subtotal, pajak, ongkir, totalKeseluruhan) {
                                                document.getElementById('id').value = productId;
                                                document.getElementById('order_id').value = orderID;
                                                document.getElementById('invoice').value = invoice;
                                                document.getElementById('nama_produk').value = productName;
                                                document.getElementById('harga_produk').value = hargaProduk;
                                                document.getElementById('image_produk').value = imageProduct;
                                                document.getElementById('tipe_produk').value = tipeProduct;
                                                document.getElementById('warna_produk').value = warnaProduct;
                                                document.getElementById('jumlah_produk').value = jumlah;
                                                document.getElementById('subtotal_produk').value = subtotal;
                                                document.getElementById('pajak').value = pajak;
                                                document.getElementById('ongkir').value = ongkir;
                                                document.getElementById('total_keseluruhan').value = totalKeseluruhan;

                                                document.getElementById('addToCartForm').submit();
                                            }
                                        </script>
                                        @else
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.querySelectorAll('.btn').forEach(function(button) {
                                                    button.addEventListener('click', function(event) {
                                                        event.preventDefault();
                                                        alert('Silakan login terlebih dahulu untuk melakukan transaksi!');
                                                        window.location.href = "{{route('auth.login')}}";
                                                    });
                                                });
                                            });
                                        </script>
                                        <a href="{{route('auth.login')}}" class="btn btn-success me-10 mb-10"><i class="mdi mdi-shopping"></i> Beli Sekarang</a>
                                        <a href="{{route('auth.login')}}" class="btn btn-info me-10 mb-10"><i class="mdi mdi-tooltip-text"></i> Buat Penawaran</a>
                                        <a href="{{route('auth.login')}}" class="btn btn-danger me-10 mb-10"><i class="mdi mdi-basket"></i> Tambah Ke Keranjang</a>
                                        @endif
                                    </div>
                                    <h4 class="box-title mt-20 d-block">Metode Pembayaran</h4>
                                    <ul class="list list-unstyled mb-30">
                                        <li><i class="fa fa-check text-danger float-none"></i> Kredit</li>
                                        <li><i class="fa fa-check text-danger float-none"></i> Tunai</li>
                                        <li><i class="fa fa-check text-danger float-none"></i> Transfer Bank</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs customtab2" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#home7" role="tab">Deskripsi</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#profile7" role="tab">Spesifikasi</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#profile8" role="tab">Kredit</a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home7" role="tabpanel">
                                            <div class="px-15 pt-30">
                                                <h4 class="fw-500">{{$produk->judul}}</h4>
                                                <p>{!! nl2br(e($produk->deskripsi)) !!}</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile7" role="tabpanel">
                                            <div class="px-15 pt-30">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-weight: 700;">Merk</td>
                                                                <td> {{$produk->merk}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 700;">Kilometer</td>
                                                                <td> {{$produk->kilometer}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 700;">Tahun</td>
                                                                <td> {{$produk->tahun}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 700;">Transmisi</td>
                                                                <td> {{$produk->transmisi}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 700;">Kapasitas Mesin</td>
                                                                <td> {{$produk->kapasitas_mesin}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 700;">Bahan Bakar</td>
                                                                <td> {{$produk->bahan_bakar}} </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile8" role="tabpanel">
                                            <div class="px-15 pt-30">
                                                <h4 class="fw-500">Kredit</h4>
                                                <span>Silahkan Buat Pengajuan Kredit dan pilih opsi pengajuan yang sesuai dengan Anda:</span>
                                            </div>
                                            <br>
                                            @if (Auth::check())
                                            <button type="button" class="btn btn-primary" onclick="add_ajax()"> Buat Kredit</button>
                                            @else
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    document.querySelectorAll('.btn').forEach(function(button) {
                                                        button.addEventListener('click', function(event) {
                                                            event.preventDefault();
                                                            alert('Silakan login terlebih dahulu untuk melakukan transaksi!');
                                                            window.location.href = "{{route('auth.login')}}";
                                                        });
                                                    });
                                                });
                                            </script>
                                            <a href="{{route('auth.login')}}" class="btn btn-primary"> Buat Kredit</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <li> <i class="fa fa-phone"></i> <span>0852-6552-7838 </span></li>
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
                                <li><a href="#" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @if (Auth::check())
    <div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Form Kredit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="nama_produk" value="{{$produk->judul}}">
                                            <div class="form-group">
                                                <h5>Nama <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>No Handphone / WA <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="no_hp" class="form-control" required data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Upload Identitas diri (KTP/SIM) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="ktp_sim" class="form-control" required>
                                                </div>
                                                <small class="text-danger">Upload Dalam Bentuk JPG/JPEG/PNG</small>
                                            </div>
                                            <div class="form-group">
                                                <h5>Upload Kartu Keluarga (KK) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="kk" class="form-control" required>
                                                </div>
                                                <small class="text-danger">Upload Dalam Bentuk JPG/JPEG/PNG</small>
                                            </div>
                                            <div class="form-group">
                                                <h5>Upload Slip Gaji <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="slip_gaji" class="form-control" required>
                                                </div>
                                                <small class="text-danger">Upload Dalam Bentuk JPG/JPEG/PNG</small>
                                            </div>
                                            <div class="form-group">
                                                <h5>Masukkan Alamat Saat Ini <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukkan Alamat"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Pilih Tahun</label>
                                                <select class="form-select" name="thn_bayar" id="thn_bayar" onchange="showForm(this.value)">
                                                    <option value="">---Pilih Tahun---</option>
                                                    <option value="1 Tahun">1 Tahun</option>
                                                    <option value="2 Tahun">2 Tahun</option>
                                                    <option value="3 Tahun">3 Tahun</option>
                                                    <option value="4 Tahun">4 Tahun</option>
                                                    <option value="5 Tahun">5 Tahun</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="form5" style="display: none;">
                                                <label class="form-label">Bayar Pertama</label>
                                                <input type="text" name="bayar_pertama" class="form-control" value="Rp. 7.500.000" readonly>
                                                <label class="form-label">Cicilan Perbulan</label>
                                                <input type="text" name="cicilan" class="form-control" value="Rp. 2.700.000" readonly>
                                            </div>
                                            <div class="form-group" id="form4" style="display: none;">
                                                <label class="form-label">Bayar Pertama</label>
                                                <input type="text" name="bayar_pertama" class="form-control" value="Rp. 8.360.000" readonly>
                                                <label class="form-label">Cicilan Perbulan</label>
                                                <input type="text" name="cicilan" class="form-control" value="Rp. 3.130.000" readonly>
                                            </div>
                                            <div class="form-group" id="form3" style="display: none;">
                                                <label class="form-label">Bayar Pertama</label>
                                                <input type="text" name="bayar_pertama" class="form-control" value="Rp. 9.840.000" readonly>
                                                <label class="form-label">Cicilan Perbulan</label>
                                                <input type="text" name="cicilan" class="form-control" value="Rp. 3.870.000" readonly>
                                            </div>
                                            <div class="form-group" id="form2" style="display: none;">
                                                <label class="form-label">Bayar Pertama</label>
                                                <input type="text" name="bayar_pertama" class="form-control" value="Rp. 12.820.000" readonly>
                                                <label class="form-label">Cicilan Perbulan</label>
                                                <input type="text" name="cicilan" class="form-control" value="Rp. 5.610.000" readonly>
                                            </div>
                                            <div class="form-group" id="form1" style="display: none;">
                                                <label class="form-label">Bayar Pertama</label>
                                                <input type="text" name="bayar_pertama" class="form-control" value="Rp. 21.620.000" readonly>
                                                <label class="form-label">Cicilan Perbulan</label>
                                                <input type="text" name="cicilan" class="form-control" value="Rp. 9.760.000" readonly>
                                            </div>
                                            <script>
                                                function showForm(selectedValue) {
                                                    if (selectedValue == "5 Tahun") {
                                                        document.getElementById("form5").style.display = "block";
                                                    } else {
                                                        document.getElementById("form5").style.display = "none";
                                                    }
                                                    if (selectedValue == "4 Tahun") {
                                                        document.getElementById("form4").style.display = "block";
                                                    } else {
                                                        document.getElementById("form4").style.display = "none";
                                                    }
                                                    if (selectedValue == "3 Tahun") {
                                                        document.getElementById("form3").style.display = "block";
                                                    } else {
                                                        document.getElementById("form3").style.display = "none";
                                                    }
                                                    if (selectedValue == "2 Tahun") {
                                                        document.getElementById("form2").style.display = "block";
                                                    } else {
                                                        document.getElementById("form2").style.display = "none";
                                                    }
                                                    if (selectedValue == "1 Tahun") {
                                                        document.getElementById("form1").style.display = "block";
                                                    } else {
                                                        document.getElementById("form1").style.display = "none";
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" onclick="save()" id="btnSaveAjax" class="btn btn-success text-start">
                        Simpan
                    </a>
                    <button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!-- Vendor JS -->
    <script src="{{asset('user/js/vendors.min.js')}}"></script>
    <!-- Corenav Master JavaScript -->
    <script src="{{asset('user/corenav-master/coreNavigation-1.1.3.js')}}"></script>
    <script src="{{asset('user/js/nav.js')}}"></script>
    <script src="{{asset('user/js/pages/chat-popup.js')}}"></script>
    <script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>

    <!-- EduAdmin front end -->
    <script src="{{asset('user/js/template.js')}}"></script>
    <script src="{{asset('user/js/pages/ecommerce_details.js')}}"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        function resetForm() {
            $('#formAdd')[0].reset();
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#myModalLabel1').html("Form Kredit");
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#m_modal').modal('show');
        }

        function save() {
            let url;

            if (method === 'add') {
                url = "{{ route('kredit.store') }}";
            } else {
                url = "{{ route('kredit.update') }}";
            }

            var formData = new FormData();
            formData.append('id', $('[name="id"]').val());
            formData.append('nama_produk', $('[name="nama_produk"]').val());
            formData.append('name', $('[name="name"]').val());
            formData.append('email', $('[name="email"]').val());
            formData.append('no_hp', $('[name="no_hp"]').val());
            formData.append('ktp_sim', $('[name="ktp_sim"]')[0].files[0]);
            formData.append('kk', $('[name="kk"]')[0].files[0]);
            formData.append('slip_gaji', $('[name="slip_gaji"]')[0].files[0]);
            formData.append('alamat', $('[name="alamat"]').val());
            formData.append('thn_bayar', $('[name="thn_bayar"]').val());
            formData.append('bayar_pertama', $('[name="bayar_pertama"]').val());
            formData.append('cicilan', $('[name="cicilan"]').val());
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        $('#m_modal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil..',
                            text: 'Kredit Berhasil Di Buat',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                            window.location.href = "{{ route('kredit.index') }}";
                        });
                    } else {
                        Swal.fire({
                            text: data.message,
                            icon: 'warning'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: 'Oops',
                        text: 'Kredit Gagal Di Buat!',
                        icon: 'error'
                    });
                }
            });
        }
    </script>

</body>

</html>