@extends('Admin.layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Penjualan</h3>
    </div>

    <div class="box">
        <div class="box-body">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('filter.penjualan') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Transaksi</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status" id="status">
                                    <option value="Diterima">Diterima</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="tanggal_mulai" name="created_at">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary me-1">
                            <i class="ti-search"></i> Cari
                        </button>
                        <a href="#" class="btn btn-success" id="exportButton">
                            <i class="ti-export"></i> Ekspor ke Excel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">
        <h3 class="box-title">Laporan Penjualan</h3>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="invoice" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pesanan) && $pesanan->count() > 0)
                    @foreach($pesanan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->order_id }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->jumlah_produk }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('exportButton').addEventListener('click', function(event) {
        event.preventDefault();

        // Ambil nilai dari input tanggal_mulai dan status
        var tanggalMulai = document.getElementById('tanggal_mulai').value;
        var status = document.getElementById('status').value;

        // Buat URL dengan penggantian placeholder
        var url = "{{ route('export.penjualan', ['tanggal_mulai' => ':tanggal_mulai', 'status' => ':status']) }}";
        url = url.replace(':tanggal_mulai', tanggalMulai).replace(':status', status);

        // Redirect ke URL yang telah diperbarui
        window.location.href = url;
    });
</script>
@endsection