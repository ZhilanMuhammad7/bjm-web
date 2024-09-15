<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <title>Invoice</title>

    <!-- Custom Style -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }
        .content-header {
            background-color: #f4f4f4;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content-header .page-title {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .invoice {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .invoice .page-header {
            margin-bottom: 20px;
        }
        .invoice .page-header h2 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .invoice .page-header .pull-right {
            text-align: right;
        }
        .invoice .page-header .pull-right h3 {
            margin: 0;
            color: #666;
            font-size: 18px;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        .invoice-info .invoice-col {
            margin-bottom: 20px;
        }
        .invoice-info .invoice-col strong {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 14px; /* Ukuran font dikurangi */
        }
        .invoice-info .invoice-col address {
            margin: 0;
            color: #666;
            font-size: 12px; /* Ukuran font dikurangi */
        }
        .invoice-info .invoice-col address strong {
            color: #333;
            font-size: 14px; /* Ukuran font dikurangi */
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details div {
            margin-bottom: 10px;
            color: #666;
            font-size: 12px; /* Ukuran font dikurangi */
        }
        .invoice-details div b {
            color: #333;
            font-size: 14px; /* Ukuran font dikurangi */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            background-color: #f4f4f4;
            color: #333;
            font-size: 12px; /* Ukuran font dikurangi */
            padding: 10px;
            border: 1px solid #ddd;
        }
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .text-end {
            text-align: right;
        }
        .text-blue {
            color: #007bff;
        }
        .fs-24 {
            font-size: 24px;
        }
        .fs-30 {
            font-size: 30px;
        }
        .lead {
            font-size: 16px;
            color: #333;
        }
        .text-danger {
            color: #dc3545;
        }
        .total-payment {
            margin-top: 20px;
        }
        .total-payment h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }
    </style>

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container-full">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <h3 class="page-title">Invoice</h3>
                        </div>

                    </div>
                </div>
                <section class="invoice printableArea">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <h2 class="d-inline"><span class="fs-30">Invoice BJM</span></h2>
                                <div class="pull-right text-end">
                                    <h3>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-md-6 invoice-col">
                            <strong>From</strong>
                            <address>
                                <strong class="text-blue fs-24">BJM Mobilindo</strong><br>
                                <strong class="d-inline">Arengka 1 No 36 D-E, Jl. Soekarno - Hatta, Sidomulyo Tim, kecamatan Marpoyan, Kota Pekanbaru, Riau 28125</strong><br>
                                <strong>Phone: 0852-6552-7838 &nbsp;&nbsp;&nbsp;&nbsp; Email: info@bjm.com</strong>
                            </address>
                        </div>
                        <div class="col-md-6 invoice-col text-end">
                            <strong>To</strong>
                            <address>
                                <strong class="text-blue fs-24">{{ $user->name }}</strong><br>
                                <strong>Phone: {{ $user->no_hp }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $user->email }}</strong>
                            </address>
                        </div>
                        <div class="col-sm-12 invoice-col mb-15">
                            <div class="invoice-details row no-margin">
                                <div class="col-md-6 col-lg-3"><b>Invoice </b>#{{ $data->invoice }}</div>
                                <div class="col-md-6 col-lg-3"><b>Order ID:</b> {{ $data->order_id }}</div>
                                <div class="col-md-6 col-lg-3"><b>Tanggal Pesanan:</b> {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</div>
                                <div class="col-md-6 col-lg-3"><b>Account:</b> {{ $data->user->id }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered" id="invoice">
                                <tbody>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Gambar</th>
                                        <th>Tipe</th>
                                        <th>Warna</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td><img src="{{ Storage::url($data->image_produk) }}" alt="" width="100"></td> <!-- Pastikan direktori gambar benar dan gambar ada di sana -->
                                        <td>{{ $data->tipe_produk }}</td>
                                        <td>{{ $data->warna_produk }}</td>
                                        <td class="text-end" style="font-size: 12px;">{{ $data->jumlah_produk }}</td>
                                        <td class="text-end" style="font-size: 12px;">Rp. {{ number_format($data->harga_produk, 0, ',', '.') }}</td>
                                        <td class="text-end" style="font-size: 12px;">Rp. {{ number_format($data->jumlah_produk * $data->harga_produk, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <p class="lead"><b>Tanggal Pesanan</b><span class="text-danger"> {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }} </span></p>

                            <div>
                                <p>jumlah Total : Rp. {{number_format($data->subtotal_produk, 0, ',', '.') }}</p>
                                <p>Pajak (5%) : Rp. {{number_format($data->pajak, 0, ',', '.') }}</p>
                            </div>
                            <div class="total-payment">
                                <h3><b>Total :</b> Rp. {{number_format($data->total_keseluruhan, 0, ',', '.') }}</h3>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
</body>

</html>