@extends('layouts.app')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="tambah_kelas">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                    rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="black" />
                            </svg>
                        </span>
                        Tambah Jurusan
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_kelas">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Nama Jurusan</th>
                        <th class="min-w-125px">Singkatan</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="modalFormTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle"></h5>
                    <button type="button" class="btn btn-default close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-submit">
                    <div class="modal-body">
                        <div class="fv-row mb-10">
                            <input type="hidden" name="id" id="id" value="">
                            <label class="fs-6 fw-bold form-label mb-2">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control"
                                placeholder="Masukan Jurusan" value="">
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold form-label mb-2">Singkatan Jurusan</label>
                            <input type="text" name="singkatan_jurusan" id="singkatan_jurusan" class="form-control"
                                placeholder="Masukan Singkatan Jurusan" value="">
                        </div>

                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold form-label mb-2">Deskripsi Jurusan</label>
                            <textarea name="deskripsi_jurusan" id="deskripsi_jurusan" class="form-control" cols="30" rows="10"
                                placeholder="Silahkan isi Deskrispi Sesuai Jurusan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Mohon Tunggu ...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#table_kelas').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('jurusan.data') }}',
                data: function(d) {
                    d.name = $('.searching').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    // className: "d-flex align-items-center",
                },
                {
                    data: 'nama_jurusan',
                    name: 'nama_jurusan',
                    className: "d-flex align-items-center",
                },

                {
                    data: 'singkatan_jurusan',
                    name: 'singkatan_jurusan'
                },

                {
                    data: 'actions',
                    name: 'actions',
                    className: "text-end",
                    orderable: false,
                    searchable: false,
                },

            ]
        });

        function hapus(id) {
            d = document.getElementById('hapus');
            var jurusan = d.getAttribute("data-jurusan");
            Swal.fire({
                text: "Anda yakin mengapus jurusan " + jurusan + " ini ?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak, Batalkan",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function(t) {
                t.value ?
                    $.ajax({
                        url: '/jurusan/hapus/' + id,
                        type: "DELETE",
                        dataType: 'JSON',
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Mohon Tunggu ...',
                                allwOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        success: function(res) {
                            if (res.sukses == true) {
                                Swal.fire(
                                    'Yeay !',
                                    res.pesan,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error !',
                                    res.pesan,
                                    'error'
                                )
                            }
                            table.ajax.reload();
                        },
                        error: function(er) {
                            var message = er.responseJSON.message
                            Swal.fire(
                                'Error !',
                                message,
                                'error'
                            )
                        }
                    }) :
                    "cancel" === t.dismiss && Swal.fire({
                        text: kelas + " tidak dihapus.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    })
            }))
        }

        function edit(element) {
            var id = element.getAttribute("data-id");

            $.ajax({
                url: '/jurusan/get/' + id,
                type: "GET",
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Mohon Tunggu ...',
                        allwOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                success: function(res) {
                    swal.close()
                    $('#nama_jurusan').val(res.nama_jurusan);
                    $('#singkatan_jurusan').val(res.singkatan_jurusan);
                    $('#deskripsi_jurusan').val(res.deskripsi_jurusan);
                    $('#id').val(res.id);
                    $('#modalForm').modal('show');
                    $('#modalFormTitle').html('Edit Jurusan');
                },
                error: function(er) {
                    console.log(er);
                }
            })
        }

        $('#tambah_kelas').click(function() {
            $('#modalForm').modal('show');
            $('#modalFormTitle').html('Tambah Jurusan');
        })

        $('#form-submit').submit(function(e) {
            e.preventDefault();
            s = document.getElementById("submit");
            var nama_jurusan = $('#nama_jurusan').val();
            var singkatan_jurusan = $('#singkatan_jurusan').val();
            var deskripsi_jurusan = $('#deskripsi_jurusan').val();
            var id = $('#id').val();
            $.ajax({
                url: '{{ route('jurusan.save') }}',
                type: 'POST',
                data: {
                    id: id,
                    nama_jurusan: nama_jurusan,
                    singkatan_jurusan: singkatan_jurusan,
                    deskripsi_jurusan: deskripsi_jurusan,
                },
                beforeSend: function() {
                    s.setAttribute("data-kt-indicator", "on");
                    $('#submit').prop('disabled', true);
                },
                success: function(res) {
                    console.log(res)
                    s.removeAttribute("data-kt-indicator");
                    $('#submit').prop('disabled', false);
                    $('#modalForm').modal('hide');
                    if (res.sukses == true) {
                        Swal.fire(
                            'Yeay !',
                            res.pesan,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error !',
                            res.pesan,
                            'error'
                        )
                    }
                    table.ajax.reload();
                },
                error: function(er) {
                    console.log(er)
                    s.removeAttribute("data-kt-indicator");
                    $('#submit').prop('disabled', false);
                    var message = er.responseJSON.message
                    Swal.fire(
                        'Error !',
                        message,
                        'error'
                    )
                }
            })
        });

        $('.close').click(function() {
            $('#modalForm').modal('hide');
            $('#form-submit').trigger('reset');
        });

        $('#modalForm').on('hidden.bs.modal', function() {
            $('#form-submit').trigger('reset');
        })
    </script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
@endpush
