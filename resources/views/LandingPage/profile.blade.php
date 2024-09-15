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

    <!-- The social media icon bar -->
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
    <section class="bg-img pt-150 pb-100" data-overlay-light="3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="page-title text-dark">Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page content -->

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form action="{{ route('customer_profile_submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{asset('images/avatar/1.jpg')}}" alt="" class="profile-photo w_100_p">
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Email *</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                                <li> <i class="fa fa-phone"></i> <span>+(1) 123-878-1649 </span><br><span>0852-6552-7838</span></li>
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
                    <div class="col-md-6 col-12 text-md-start text-center"> © 2020 <span class="text-white">EduAdmin</span> All Rights Reserved.</div>
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


    <!-- Vendor JS -->
    <script src="{{asset('user/js/vendors.min.js')}}"></script>
    <!-- Corenav Master JavaScript -->
    <script src="{{asset('user/corenav-master/coreNavigation-1.1.3.js')}}"></script>
    <script src="{{asset('user/js/nav.js')}}"></script>
    <script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>

    <!-- EduAdmin front end -->
    <script src="{{asset('user/js/template.js')}}"></script>



</body>

</html>