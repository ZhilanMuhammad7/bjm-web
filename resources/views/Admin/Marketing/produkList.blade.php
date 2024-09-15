@extends('Admin.layouts.master')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Tabel Produk</h3>
        </div>
        @if(auth()->user()->role == 'marketing')
        <div class="justify-content-between">
            <button type="button" class="btn btn-info" onclick="add_ajax()">
                <i class="ti-plus"></i> Tambah Data Produk
            </button>
            <br>
        </div>
        @endif
    </div>
</div>

<div class="box-body">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Brand</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Kilometer</th>
                    <th>Bahan Bakar</th>
                    <th>Warna</th>
                    <th>Transmisi</th>
                    <th>Kapasitas Mesin</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    @if(auth()->user()->role == 'marketing')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @if(isset($data) && $data->count() > 0)
                @foreach($data as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->judul }}</td>
                    <td>{{ $row->brand }}</td>
                    <td>{{ $row->merk }}</td>
                    <td>{{ $row->tahun }}</td>
                    <td>{{ $row->kilometer }}</td>
                    <td>{{ $row->bahan_bakar }}</td>
                    <td>{{ $row->warna }}</td>
                    <td>{{ $row->transmisi }}</td>
                    <td>{{ $row->kapasitas_mesin }}</td>
                    <td>{{ $row->tipe }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>
                        <img src="{{ Storage::url($row->gambar1) }}" alt="product" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage">
                        <div class="modal fade" id="viewImage" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewImageModalLabel">Foto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ Storage::url($row->gambar1) }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @if(auth()->user()->role == 'marketing')
                    <td>
                        <a href="javascript:void(0)" onclick="edit('{{ $row->id }}')" class="text-info me-10"><i class="ti-marker-alt"></i></a>
                        <a href="javascript:void(0)" onclick="hapus('{{ $row->id }}')" class="text-danger"><i class="ti-trash"></i></a>
                    </td>
                    @endif
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="13" class="text-center">Data Produk Belum Ditambahkan</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Form Data Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="produk_id" value="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Judul <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="judul" class="form-control" required placeholder="Judul">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Brand <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="brand" class="form-control" required placeholder="Brand">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Merk <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="merk" class="form-control" required placeholder="Merk">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tahun <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="tahun" class="form-control" required placeholder="Tahun">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Kilometer <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="kilometer" class="form-control" required placeholder="Kilometer">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Bahan Bakar</label>
                                            <select class="form-select" name="bahan_bakar">
                                                <option value="Diesel">Diesel</option>
                                                <option value="Bensin">Bensin</option>
                                                <option value="Hybrid">Hybrid</option>
                                                <option value="Listrik">Listrik</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <h5>Warna <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="warna" class="form-control" required placeholder="Warna">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Transmisi</label>
                                            <select class="form-select" name="transmisi">
                                                <option value="Automatic">Automatic</option>
                                                <option value="Manual">Manual</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <h5>Kapasitas Mesin <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="kapasitas_mesin" class="form-control" required placeholder="Kapasitas Mesin">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tipe <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="tipe" class="form-control" required placeholder="Tipe">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Harga <span class="text-danger">*</span></h5>
                                            <div class="input-group"> <span class="input-group-addon">RP</span>
                                                <input type="number" name="harga" class="form-control" required data-validation-required-message="This field is required" placeholder="Harga">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" id="" class="form-control" placeholder="Masukkan Deskripsi" rows="7"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5>Masukkan Gambar 1 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar1" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Masukkan Gambar 2 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar2" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Masukkan Gambar 3 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar3" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Masukkan Gambar 4 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar4" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Masukkan Gambar 5 <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar5" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                                        </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    function resetForm() {
        $('#formAdd')[0].reset();
    }

    function add_ajax() {
        method = 'add';
        resetForm();
        $('#myModalLabel1').html("Tambah Produk");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal').modal('show');
    }

    function save() {
        let url;

        if (method === 'add') {
            url = "{{ route('produk.store') }}";
        } else {
            url = "{{ route('produk.update') }}";
        }

        var formData = new FormData();
        formData.append('id', $('[name="id"]').val());
        formData.append('produk_id', $('[name="produk_id"]').val());
        formData.append('judul', $('[name="judul"]').val());
        formData.append('brand', $('[name="brand"]').val());
        formData.append('merk', $('[name="merk"]').val());
        formData.append('tahun', $('[name="tahun"]').val());
        formData.append('kilometer', $('[name="kilometer"]').val());
        formData.append('bahan_bakar', $('[name="bahan_bakar"]').val());
        formData.append('warna', $('[name="warna"]').val());
        formData.append('transmisi', $('[name="transmisi"]').val());
        formData.append('kapasitas_mesin', $('[name="kapasitas_mesin"]').val());
        formData.append('tipe', $('[name="tipe"]').val());
        formData.append('harga', $('[name="harga"]').val());
        formData.append('deskripsi', $('[name="deskripsi"]').val());
        formData.append('gambar1', $('[name="gambar1"]')[0].files[0]);
        formData.append('gambar2', $('[name="gambar2"]')[0].files[0]);
        formData.append('gambar3', $('[name="gambar3"]')[0].files[0]);
        formData.append('gambar4', $('[name="gambar4"]')[0].files[0]);
        formData.append('gambar5', $('[name="gambar5"]')[0].files[0]);
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
                        text: 'Data Anda berhasil disimpan',
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

    function edit(id) {
        method = 'edit';
        resetForm();

        $('#myModalLabel1').html("Edit Produk");

        $.ajax({
            url: "{{ url('produk/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.data) {
                    $('#formAdd')[0].reset();
                    $('[name="id"]').val(data.data.id);
                    $('[name="produk_id"]').val(data.data.produk_id);
                    $('[name="judul"]').val(data.data.judul);
                    $('[name="brand"]').val(data.data.brand);
                    $('[name="merk"]').val(data.data.merk);
                    $('[name="tahun"]').val(data.data.tahun);
                    $('[name="kilometer"]').val(data.data.kilometer);
                    $('[name="bahan_bakar"]').val(data.data.bahan_bakar);
                    $('[name="warna"]').val(data.data.warna);
                    $('[name="transmisi"]').val(data.data.transmisi);
                    $('[name="kapasitas_mesin"]').val(data.data.kapasitas_mesin);
                    $('[name="tipe"]').val(data.data.tipe);
                    $('[name="harga"]').val(data.data.harga);
                    $('[name="deskripsi"]').val(data.data.deskripsi);

                    $('#m_modal').modal('show');
                } else {
                    Swal.fire("Oops", "Gagal mengambil data!", "error");
                }
                mApp.unblockPage();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                mApp.unblockPage();
                Swal.fire("Error", "Gagal mengambil data dari server!", "error");
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda yakin ingin hapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "<span><i class='flaticon-interface-1'></i><span>Ya, Hapus!</span></span>",
            confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--icon",
            cancelButtonText: "<span><i class='flaticon-close'></i><span>Batal Hapus</span></span>",
            cancelButtonClass: "btn btn-metal m-btn m-btn--pill m-btn--icon",
            customClass: {
                confirmButton: 'btn btn-danger m-btn m-btn--pill m-btn--icon',
                cancelButton: 'btn btn-metal m-btn m-btn--pill m-btn--icon'
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('produk') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status === true) {
                            Swal.fire({
                                title: "Berhasil..",
                                text: "Data Anda berhasil dihapus",
                                icon: "success"
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Oops", "Data gagal dihapus!", "error");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire("Oops", "Data gagal dihapus!", "error");
                    }
                });
            }
        });
    }
</script>
@endsection