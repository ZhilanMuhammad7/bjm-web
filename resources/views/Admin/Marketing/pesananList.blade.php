@extends('Admin.layouts.master')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Pesanan</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Photo</th>
                                <th>Merk Mobil</th>
                                <th>Jumlah</th>
                                <th>Tanggal Beli</th>
                                <th>Status</th>
                                @if(auth()->user()->role == 'marketing')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>#{{ $row->invoice }}</td>
                                <td>{{ $row->user->name ?? 'N/A' }}</td>
                                <td><img src="{{ Storage::url($row->image_produk) }}" alt="product" width="50"></td>
                                <td>{{ $row->nama_produk }}</td>
                                <td>{{ $row->jumlah_produk }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
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
                                @if(auth()->user()->role == 'marketing')
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="add_ajax('{{ $row->id }}')">
                                        Konfirmasi
                                    </button>
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

@if($kredit->count() > 0)
<div class="me-auto">
    <h3 class="page-title">Data Kredit</h3>
</div>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
                        <thead>
                            <tr>
                                <th>Nama Pemesan</th>
                                <th>No Handphone</th>
                                <th>KTP/SIM</th>
                                <th>Kartu Keluarga/KK</th>
                                <th>Slip Gaji</th>
                                <th>Alamat</th>
                                <th>Nama Produk</th>
                                <th>Tahun Bayar</th>
                                <th>Bayar Pertama</th>
                                <th>Cicilan</th>
                                <th>Payment Method</th>
                                <th>Bukti Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                @if(auth()->user()->role == 'marketing')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kredit as $row)
                            <tr>
                                <td>{{ $row->user->name ?? 'N/A' }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>
                                    <img src="{{ Storage::url($row->ktp_sim) }}" alt="ktp/sim" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage">
                                    <div class="modal fade" id="viewImage" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewImageModalLabel">KTP/SIM</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ Storage::url($row->ktp_sim) }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ Storage::url($row->kk) }}" alt="kartu keluarga" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage1">
                                    <div class="modal fade" id="viewImage1" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewImageModalLabel">Kartu Keluarga</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ Storage::url($row->kk) }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ Storage::url($row->slip_gaji) }}" alt="slip gaji" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage2">
                                    <div class="modal fade" id="viewImage2" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewImageModalLabel">Slip Gaji</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ Storage::url($row->slip_gaji) }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->nama_produk }}</td>
                                <td>{{ $row->thn_bayar }}</td>
                                <td>{{ $row->bayar_pertama }}</td>
                                <td>{{ $row->cicilan }}</td>
                                <td>{{ $row->payment_method }}</td>
                                <td>
                                    <img src="{{ Storage::url($row->bukti_tf) }}" alt="bukti bayar" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage3">
                                    <div class="modal fade" id="viewImage3" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewImageModalLabel">Bukti Bayar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ Storage::url($row->bukti_tf) }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($row->status == 'Diterima')
                                    <span class="badge badge-pill badge-success">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Diproses')
                                    <span class="badge badge-pill badge-warning">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Menunggu Pembayaran')
                                    <span class="badge badge-pill badge-info">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Ditolak')
                                    <span class="badge badge-pill badge-danger">{{ $row->status }}</span>
                                    @else
                                    <span>{{ $row->status }}</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role == 'marketing')
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="add_ajax_kredit('{{ $row->id }}')">
                                        Konfirmasi
                                    </button>
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
@endif

<div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="#" onclick="save_kredit()" id="btnSaveAjax" class="btn btn-success text-start">
                    Simpan
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function resetForm() {
        $('#formAdd')[0].reset();
    }

    function add_ajax_kredit(id) {
        method = 'add';
        $('[name="id"]').val(id);
        resetForm();
        $('#myModalLabel1').html("Konfirmasi Pesanan");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal').modal('show');
    }

    function save_kredit() {

        const formData = $('#formAdd').serialize();

        $.ajax({
            url: "{{ route('pesanan.approvalKredit') }}",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $('#m_modal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil..',
                        text: 'Approval Berhasil',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
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
                    text: 'Data gagal disimpan!',
                    icon: 'error'
                });
            }
        });

    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function resetForm() {
        $('#formAdd')[0].reset();
    }

    function add_ajax(id) {
        method = 'add';
        $('[name="id"]').val(id);
        resetForm();
        $('#myModalLabel1').html("Konfirmasi Pesanan");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal').modal('show');
    }

    function save() {

        const formData = $('#formAdd').serialize();

        $.ajax({
            url: "{{ route('pesanan.approval') }}",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $('#m_modal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil..',
                        text: 'Approval Berhasil',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
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
                    text: 'Data gagal disimpan!',
                    icon: 'error'
                });
            }
        });

    }
</script>

@endsection