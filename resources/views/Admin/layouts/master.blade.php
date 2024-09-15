<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/favicon.ico')}}">

    <title>BJM - Admin</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('admin/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/skin_color.css')}}">

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent text-white" data-toggle="push-menu" role="button">
                    <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </a>
                <!-- Logo -->
                <a href="#" class="logo" style="overflow: visible;">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{asset('images/logo-bjm1.png')}}" alt="logo"></span>
                        <!-- <span class="dark-logo"><img src="{{asset('images/logo-dark.png')}}" alt="logo" style="width: 50%;"></span> -->
                        <!-- <h3>BJM <span> Mobilindo</span></h3> -->
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    @if(auth()->user()->role == 'marketing')
                        <h4>Selamat Datang, Marketing</h4>
                    @endif

                    @if(auth()->user()->role == 'supervisor')
                        <h4>Selamat Datang, Supervisor</h4>
                    @endif

                    @if(auth()->user()->role == 'owner')
                        <h4>Selamat Datang, Owner</h4>
                    @endif

                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
                                <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">
                        <li class="btn-group nav-item d-lg-inline-flex d-none">
                            <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
                                <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                        
                        <!-- Notifications -->
                        
                        <!-- User Account-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" title="User">
                                <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                            <ul class="dropdown-menu animated flipInX">
                                <li class="user-body">
                                    <a class="dropdown-item" href="{{route('auth.login')}}"><i class="ti-lock text-muted me-2"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar position-relative">
                <div class="multinav" style="margin-top: 80px;">
                    <div class="multinav-scroll" style="height: 100%;">
                        <ul class="sidebar-menu" data-widget="tree">
                            @if(Auth::check() && Auth::user()->role == 'marketing')
                            <li>
                                <a href="{{route('dashboard.index')}}">
                                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('produk.index')}}">
                                    <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pesanan.pesanan')}}">
                                    <i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <span>Pesanan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pesanan.transaksi')}}">
                                    <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>
                            @endif

                            @if(Auth::check() && Auth::user()->role == 'supervisor')
                            <li>
                                <a href="{{route('dashboard.index')}}">
                                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('produk.index')}}">
                                    <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pesanan.pesanan')}}">
                                    <i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <span>Pesanan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pesanan.transaksi')}}">
                                    <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('pengguna.tablePengguna')}}">
                                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('penjualan.index')}}">
                                    <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Laporan Penjualan</span>
                                </a>
                            </li>
                            @endif

                            @if(Auth::check() && Auth::user()->role == 'owner')
                            <li>
                                <a href="{{route('dashboard.index')}}">
                                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('penjualan.index')}}">
                                    <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Laporan Penjualan</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </section>
        </aside>
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
        </div>
        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
            </div>
            &copy; 2024 <a href="https://www.multipurposethemes.com/">BJM-Mobilindo</a>. All Rights Reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- Vendor JS -->
    <script src="{{asset('admin/js/vendors.min.js')}}"></script>
    <script src="{{asset('admin/js/pages/chat-popup.js')}}"></script>
    <script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/vendor_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor_components/fullcalendar/fullcalendar.js')}}"></script>

    <!-- EduAdmin App -->
    <script src="{{asset('admin/js/template.js')}}"></script>
    <script src="{{asset('admin/js/pages/calendar.js')}}"></script>

    <script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
    <script src="{{asset('admin/js/invoicePDF.js')}}"></script>

</body>

</html>