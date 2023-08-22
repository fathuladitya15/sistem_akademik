@extends('layouts.app')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            Gambaran Hitungan Kelas Calon Peserta Didik Baru
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_rancangan">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 text-center">
                        <th class="min-w-100px">Jurusan</th>
                        <th class="min-w-100px">L(JML SISWA)</th>
                        <th class="min-w-100px">P(JML SISWA)</th>
                        <th class="min-w-100px">Total</th>
                        <th class="min-w-100px">Jmlh Rombel</th>
                        <th class="min-w-100px">L (JML /KLS )</th>
                        <th class="min-w-100px">P (JML /KLS )</th>
                        <th class="min-w-100px">Total /KLS</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                </tbody>
            </table>
        </div>
    </div>
    <br><br>

    <div class="card">
        <form action="#">
            <div class="card-body">
                <div class="w-100">
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">JURUSAN</label>
                        <select name="jurusan" id="" class="form-control form-control-lg form-control-solid">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $jrs)
                                <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Rombel</label>
                        <select name="jurusan" id="" class="form-control form-control-lg form-control-solid">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $jrs)
                                <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar">
                <h3>~ DATA SISWA LAKI - LAKI ~</h3>
            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_absensi">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 text-center">
                        <th class="min-w-100px">Nama</th>
                        <th class="min-w-100px">Jurusan</th>
                        <th class="min-w-100px">Jenis Kelamin</th>
                        <th class="min-w-100px">Rombel</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                </tbody>
            </table>
        </div>
    </div>
    <br><br>
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar">
                <h3>~ DATA SISWA PEREMPUAN ~</h3>
            </div>
        </div>
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_users">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Nama Peserta Didik</th>
                        <th class="min-w-125px">Jurusan</th>
                        <th class="min-w-125px">Jenis Kelamin</th>
                        <th class="min-w-125px">Skor</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-bold">

                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var table = $('#table_users').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('PPDB.siswabaru.ajax') }}',
                data: function(d) {
                    d.name = $('.searching').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            pageLength: "36",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    // className: "d-flex align-items-center",
                },
                {
                    data: 'name',
                    name: 'name',
                },

                {
                    data: 'jurusan_id',
                    name: 'jurusan_id'
                },

                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },

                {
                    data: 'nilai_rata',
                    name: 'nilai_rata'
                },

            ]
        });

        $('.searching').keyup(function() {
            table.draw();
        })
    </script>
    <script>
        var table_rancangan = $('#table_rancangan').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('PPDB.siswabaru.ajax.rancangan') }}',
                data: function(d) {
                    d.name = $('.searching').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'jurusan',
                    name: 'jurusan',
                    orderable: false,
                    searchable: false,
                    // className: "d-flex align-items-center",
                },
                {
                    data: 'ljmlsiswa',
                    name: 'ljmlsiswa',
                    className: "text-center",

                },

                {
                    data: 'pjmlsiswa',
                    name: 'pjmlsiswa',
                    className: "text-center",

                },

                {
                    data: 'tjmlsiswa',
                    name: 'tjmlsiswa',
                    className: "text-center",

                },

                {
                    data: 'total_rombel',
                    name: 'total_rombel',
                    className: "text-center",

                },
                {
                    data: 'lperkelas',
                    name: 'lperkelas',
                    className: "text-center",

                },
                {
                    data: 'pperkelas',
                    name: 'pperkelas',
                    className: "text-center",
                },
                {
                    data: 'total_perkelas',
                    name: 'total_perkelas',
                    className: "text-center",

                },

            ]

        });
    </script>
    <script>
        tabel_absensi = $('#table_absensi').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            // dom: "Bfrltip",
            ajax: {
                url: '/DataSiswaBaru/data2/RPL/1',
                data: function(d) {
                    d.name = $('.searching').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            // pageLength: 36,
            columns: [{
                    data: 'nama',
                    name: 'nama',
                    orderable: false,
                    searchable: false,
                    // className: "d-flex align-items-center",
                },
                {
                    data: 'jurusan',
                    name: 'jurusan',
                    className: "text-center",

                },

                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin',
                    className: "text-center",

                },

                {
                    data: 'singkatan_jurusan',
                    name: 'singkatan_jurusan',
                    className: "text-center",

                },

            ]
        })
    </script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
@endpush
