<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>

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
                        <h2 class="page-title text-dark">Invoice</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page content -->
    <section class="printableArea py-50">
        <div class="container">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <h2 class="d-inline"><span class="fs-30">Invoice</span></h2>
                                <div class="pull-right text-end">
                                    <h3>{{ \Carbon\Carbon::now()->format('d F Y') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row invoice-info">
                        <div class="col-md-6 invoice-col">
                            <strong>Dari</strong>
                            <address>
                                <strong class="text-blue fs-24">BJM - Berkah Jaya Motor Mobilindo</strong><br>
                                Arengka 1 No 36 D-E, Jl. Soekarno - Hatta, Sidomulyo Tim., kecamatan Marpoyan, Kota Pekanbaru, Riau 28125<br>
                                <strong>No HP: 0852-6552-7838 &nbsp;&nbsp;&nbsp;&nbsp; Email: info@bjm.com</strong>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 invoice-col text-end">
                            <strong>Kepada</strong>
                            <address>
                                <strong class="text-blue fs-24">{{ Auth::user()->name }}</strong><br>
                                <strong>No HP: {{ Auth::user()->no_hp }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ Auth::user()->email }}</strong>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 invoice-col mb-15">
                            <div class="invoice-details row no-margin">
                                <div class="col-md-6 col-lg-3"><b>Invoice </b> #{{ $price->invoice }}</div>
                                <div class="col-md-6 col-lg-3"><b>Order ID:</b> {{ $price->order_id }}</div>
                                <div class="col-md-6 col-lg-3"><b>Tanggal Pembelian:</b> {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                                <div class="col-md-6 col-lg-3"><b>Account:</b> {{ Auth::user()->id }}</div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Tipe Produk</th>
                                        <th>Warna Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th class="text-end">Harga</th>
                                    </tr>
                                    @foreach($transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ Storage::url($row->image_produk) }}" alt="product" width="50" height="100%" style="cursor: pointer;"></td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>{{ $row->tipe_produk }}</td>
                                        <td>{{ $row->warna_produk }}</td>
                                        <td>{{ $row->jumlah_produk }}</td>
                                        <td class="text-end">{{ number_format($row->harga_produk, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12 text-start">
                            <p class="lead">
                                <b>Bayar Sebelum Tanggal</b>
                                <span class="text-danger"> {{ \Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }} </span>
                            </p>
                            <div>
                                <p>Jumlah Total : Rp. {{number_format($price->subtotal_produk, 0, ',', '.') }}</p>
                                <p>Pajak (5%) : Rp. {{number_format($price->pajak, 0, ',', '.') }}</p>
                                <!-- <p>Pengiriman : Rp. {{number_format($price->ongkir, 0, ',', '.') }}</p> -->
                            </div>
                            <div class="total-payment">
                                <h3><b>Total :</b> Rp. {{number_format($price->total_keseluruhan, 0, ',', '.') }}</h3>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <button id="pay-button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Bayar Sekarang</button>
                            <a href="javascript:void(0)" onclick="hapus('{{ $row->id }}')" class="btn btn-info pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                                <li> <i class="fa fa-envelope"></i> <span>info@bjm.com </span><br><span>support@EduAdmin.com </span></li>
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
                    <div class="col-md-6 col-12 text-md-start text-center"> © 2020 <span class="text-white">BJM</span> All Rights Reserved.</div>
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
    <script src="{{asset('assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js')}}"></script>

    <!-- EduAdmin front end -->
    <script src="{{asset('user/js/template.js')}}"></script>
    <script src="{{asset('user/js/pages/invoice.js')}}"></script>


    <script type="text/javascript">
        // Contoh trigger saat tombol diklik, atau kapanpun Anda perlu
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger popup snap. @TODO: Gantikan TRANSACTION_TOKEN_HERE dengan token transaksi Anda
            snap.pay('{{ $checkout2->snap_token }}', {
                onSuccess: function(result) {
                    /* Anda mungkin menambahkan implementasi Anda sendiri di sini */
                    alert("pembayaran berhasil!");
                    window.location.href = "{{ route('cekPesanan.index') }}";
                    console.log(result);
                },
                onPending: function(result) {
                    /* Anda mungkin menambahkan implementasi Anda sendiri di sini */
                    alert("menunggu pembayaran Anda!");
                    console.log(result);
                },
                onError: function(result) {
                    /* Anda mungkin menambahkan implementasi Anda sendiri di sini */
                    alert("pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    /* Anda mungkin menambahkan implementasi Anda sendiri di sini */
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            })
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        function hapus(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda yakin ingin membatalkan transaksi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<span><i class='flaticon-interface-1'></i><span>Ya!</span></span>",
                confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--icon",
                cancelButtonText: "<span><i class='flaticon-close'></i><span>Batal</span></span>",
                cancelButtonClass: "btn btn-metal m-btn m-btn--pill m-btn--icon",
                customClass: {
                    confirmButton: 'btn btn-danger m-btn m-btn--pill m-btn--icon',
                    cancelButton: 'btn btn-metal m-btn m-btn--pill m-btn--icon'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('invoiceBack') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status === true) {
                                Swal.fire({
                                    title: "Berhasil..",
                                    text: "Transaksi Anda Dibatalkan",
                                    icon: "success"
                                }).then(function() {
                                    location.reload();
                                    window.location.href = "{{ route('mobil.index') }}";
                                });
                            } else {
                                Swal.fire("Oops", "Transaksi gagal dibatalkan!", "error");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire("Oops", "Transaksi gagal dibatalkan!", "error");
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>