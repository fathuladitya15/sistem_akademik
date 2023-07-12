@extends('layouts.app')
@push('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    Pembayaran Calon PPDB
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_pembayaran">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 text-center ">
                        <th class="w-10px pe-2 text-end">No</th>
                        <th class="min-w-125px">Nama</th>
                        <th class="min-w-125px">Status Pembayaran</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script>
        var table = $('#table_pembayaran').dataTable();
    </script>
@endpush
