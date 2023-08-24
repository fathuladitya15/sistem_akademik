@extends('layouts.app')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    @if ($notif == false)
        <div class="alert alert-danger" role="alert">
            Data Tidak Valid, Cek Jurusan dan Total Kelas ... !
        </div>
    @endif
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
                        <th class="min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                </tbody>
            </table>
        </div>
    </div>
    <br><br>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
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
                    className: "text-center",

                },
                {
                    data: 'ljmlsiswa',
                    name: 'ljmlsiswa',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },

                {
                    data: 'pjmlsiswa',
                    name: 'pjmlsiswa',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },

                {
                    data: 'tjmlsiswa',
                    name: 'tjmlsiswa',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },

                {
                    data: 'total_rombel',
                    name: 'total_rombel',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },
                {
                    data: 'lperkelas',
                    name: 'lperkelas',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },
                {
                    data: 'pperkelas',
                    name: 'pperkelas',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'total_perkelas',
                    name: 'total_perkelas',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                    className: "text-center",

                },

            ]

        });
    </script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
@endpush
