@extends('Admin.layouts.master')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Transaksi</h3>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-lg invoice-archive">
                            <thead>
                                <tr>
                                    <th>#Invoice</th>
                                    <th>Nama Pemesan</th>
                                    <th>Tanggal Beli</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total harga</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td>#{{ $row->invoice }}</td>
                                    <td>{{ $row->user->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                                    <td><h6 class="mb-0 fw-bold">Rp {{ number_format($row->harga_produk, 0, ',', '.') }}</h6></td>
                                    <td>
                                        @if ($row->status == 'Diterima')
                                        <span class="badge badge-pill badge-success">{{ $row->status }}</span>
                                        @elseif ($row->status == 'Diproses')
                                        <span class="badge badge-pill badge-warning">{{ $row->status }}</span>
                                        @elseif ($row->status == 'Ditolak')
                                        <span class="badge badge-pill badge-danger">{{ $row->status }}</span>
                                        @else
                                        <span>{{ $row->status }}</span>
                                        @endif
                                    </td>
                                    @if($row->status == 'Diterima')
                                    <td class="text-center">
                                        <div class="list-icons d-inline-flex">
                                            <div class="list-icons-item dropdown">
                                                <a href="#" class="list-icons-item dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file-text"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('print-invoice', ['id' => $row->id]) }}" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection