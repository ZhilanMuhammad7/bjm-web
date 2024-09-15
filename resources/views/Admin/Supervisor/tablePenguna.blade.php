@extends('Admin.layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border" style="display: flex; justify-content: space-between;">
        <h3 class="box-title">Table Penguna</h3>
        <button type="button" class="btn btn-info" onclick="add_ajax()">
            <i class="ti-plus"></i> Tambah Data Pengguna
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->no_hp }}</td>
                        <td>{{ $row->role }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="edit('{{ $row->id }}')" class="text-info me-10"><i class="ti-marker-alt"></i></a>
                            <a href="javascript:void(0)" onclick="hapus('{{ $row->id }}')" class="text-danger"><i class="ti-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Form Data Pengguna</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Nama Lengkap <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Username <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="username" class="form-control" required data-validation-required-message="This field is required" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>No Handphone <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="no_hp" class="form-control" required data-validation-required-message="This field is required" placeholder="No Handphone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" required data-validation-required-message="This field is required" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Level <span class="text-danger">*</span></label>
                                        <select class="form-select" name="role" required data-validation-required-message="This field is required">
                                            <option value="marketing">Marketing</option>
                                            <option value="supervisor">Supervisor</option>
                                        </select>
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
        $('#myModalLabel1').html("Tambah Pengguna");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal').modal('show');
    }

    function save() {
        let url;

        if (method === 'add') {
            url = "{{ route('pengguna.store') }}";
        } else {
            url = "{{ route('pengguna.update') }}";
        }

        var formData = new FormData();
        formData.append('id', $('[name="id"]').val());
        formData.append('name', $('[name="name"]').val());
        formData.append('username', $('[name="username"]').val());
        formData.append('email', $('[name="email"]').val());
        formData.append('no_hp', $('[name="no_hp"]').val());
        formData.append('password', $('[name="password"]').val());
        formData.append('role', $('[name="role"]').val());
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

        $('#myModalLabel1').html("Edit Pengguna");

        $.ajax({
            url: "{{ url('pengguna/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.data) {
                    $('#formAdd')[0].reset();
                    $('[name="id"]').val(data.data.id);
                    $('[name="name"]').val(data.data.name);
                    $('[name="email"]').val(data.data.email);
                    $('[name="password"]').val(data.data.password);
                    $('[name="no_hp"]').val(data.data.no_hp);
                    $('[name="username"]').val(data.data.username);
                    $('[name="role"]').val(data.data.role);
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
                    url: "{{ url('pengguna') }}/" + id,
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