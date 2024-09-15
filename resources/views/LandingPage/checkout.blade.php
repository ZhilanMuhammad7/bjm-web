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

    <!---page Title --->
    <section class="bg-img pt-150 pb-20" data-overlay="7" data-overlay-light="3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="page-title text-dark">Checkout Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page content -->

    <section class="py-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Existing customer.</h4>
                        </div>
                        <div class="box-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-15">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control ps-15 bg-transparent" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-15">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control ps-15 bg-transparent" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="checkbox ms-5">
                                            <input type="checkbox" id="basic_checkbox_1">
                                            <label for="basic_checkbox_1" class="form-label">Remember Me</label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <div class="fog-pwd text-end">
                                            <a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info w-p100 mt-15">Log In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New customer?</h4>
                        </div>
                        <div class="box-body">
                            <button class="btn btn-primary">Check out as a guest</button>
                            <button class="btn btn-success">Create an account</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Alamat Tagihan</h4>
                        </div>
                        <div class="box-body pb-0">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="text" class="form-control ps-15 bg-transparent" placeholder="First Name">
                                    </div>
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="text" class="form-control ps-15 bg-transparent" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Company Name">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Address line 1">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Address line 2">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="City/Town">
                                </div>
                                <div class="row">
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="email" class="form-control ps-15 bg-transparent" placeholder="Your Email">
                                    </div>
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="tel" class="form-control ps-15 bg-transparent" placeholder="Your Phone">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Alamat Tujuan</h4>
                        </div>
                        <div class="box-body pb-0">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="text" class="form-control ps-15 bg-transparent" placeholder="First Name">
                                    </div>
                                    <div class="form-field mb-15 col-md-6 col-12">
                                        <input type="text" class="form-control ps-15 bg-transparent" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Company Name">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Address line 1">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="Address line 2">
                                </div>
                                <div class="form-field mb-15">
                                    <input type="text" class="form-control ps-15 bg-transparent" placeholder="City/Town">
                                </div>
                                <div class="form-field mb-15">
                                    <textarea class="form-control" placeholder="Comment*" rows="3" name="message"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Product Summary</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th class="w-200">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="{{asset('images/front-end-img/product/product-1.png')}}" alt="" width="80"></td>
                                            <td>Product Name Here</td>
                                            <td>3</td>
                                            <td>$270</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{asset('images/front-end-img/product/product-2.png')}}" alt="" width="80"></td>
                                            <td>Product Name Here</td>
                                            <td>3</td>
                                            <td>$270</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">Total</th>
                                            <th>$1620</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right">Coupan Discount</td>
                                            <td>$1620</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right">Delivery Charges</td>
                                            <td>$50</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right">Tax</td>
                                            <td>$18</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end fs-24 fw-700">Payable Amount</th>
                                            <th class="fs-24 fw-700">$1678</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <h4 class="box-title mb-15">Save Card</h4>
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-3 col-md-6">
                                    <div class="box bg-gradient-primary box-inverse">
                                        <div class="box-body">
                                            <h1 class="mt-0"><i class="fa fa-cc-visa"></i></h1>
                                            <h3>**** **** **** 7009</h3>
                                            <span class="pull-right">Exp date: 12/21</span>
                                            <span class="font-500">Daniel Doe</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <div class="col-lg-3 col-md-6">
                                    <div class="box bg-gradient-info box-inverse">
                                        <div class="box-body">
                                            <h1 class="mt-0"><i class="fa fa-cc-mastercard"></i></h1>
                                            <h3>**** **** **** 4125</h3>
                                            <span class="pull-right">Exp date: 12/21</span>
                                            <span class="font-500">Ethan Doe</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <div class="col-lg-3 col-md-6">
                                    <div class="box bg-gradient-warning box-inverse">
                                        <div class="box-body">
                                            <h1 class="mt-0"><i class="fa fa-cc-discover"></i></h1>
                                            <h3>**** **** **** 5124</h3>
                                            <span class="pull-right">Exp date: 12/21</span>
                                            <span class="font-500">Jayden Doe</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <div class="col-lg-3 col-md-6">
                                    <div class="box bg-gradient-danger box-inverse">
                                        <div class="box-body">
                                            <h1 class="mt-0"><i class="fa fa-cc-amex"></i></h1>
                                            <h3>**** **** **** 9578</h3>
                                            <span class="pull-right">Exp date: 12/21</span>
                                            <span class="font-500">William Doe</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col -->
                            </div>
                            <hr>
                            <h4 class="box-title mb-15">Choose payment Option</h4>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#debit-card" role="tab"><span class="hidden-sm-up"><i class="fa fa-cc"></i></span> <span class="hidden-xs-down">Kredit</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#paypal" role="tab"><span class="hidden-sm-up"><i class="fa fa-paypal"></i></span> <span class="hidden-xs-down">Transder Bank</span></a> </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="debit-card" role="tabpanel">
                                    <div class="p-30">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-6 col-12">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">CARD NUMBER</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                                            <input type="text" class="form-control" id="exampleInputuname" placeholder="Card Number">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <div class="form-group">
                                                                <label class="form-label">EXPIRATION DATE</label>
                                                                <input type="text" class="form-control" name="Expiry" placeholder="MM / YY" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-5 pull-right">
                                                            <div class="form-group">
                                                                <label class="form-label">CV CODE</label>
                                                                <input type="text" class="form-control" name="CVC" placeholder="CVC" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label">NAME OF CARD</label>
                                                                <input type="text" class="form-control" name="nameCard" placeholder="NAME AND SURNAME">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-success">Make Payment</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-5 col-md-6 col-12">
                                                <h3 class="box-title mt-10">General Info</h3>
                                                <h2><i class="fa fa-cc-visa text-info"></i>
                                                    <i class="fa fa-cc-mastercard text-danger"></i>
                                                    <i class="fa fa-cc-discover text-success"></i>
                                                    <i class="fa fa-cc-amex text-warning"></i>
                                                </h2>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</p>
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paypal" role="tabpanel">
                                    <div class="p-30">
                                        You can pay your money through paypal, for more info <a href="">click here</a><br><br>
                                        <button class="btn btn-primary"><i class="fa fa-cc-paypal"></i> Bayar Via Transfer</button>
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
                                <li> <i class="fa fa-phone"></i> <span> 0852-6552-7838 </span></li>
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
                    <div class="col-md-6 col-12 text-md-start text-center"> © 2020 <span class="text-white">BJM-Mobilindo</span> All Rights Reserved.</div>
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

    <!-- EduAdmin front end -->
    <script src="{{asset('user/js/template.js')}}"></script>



</body>

</html>