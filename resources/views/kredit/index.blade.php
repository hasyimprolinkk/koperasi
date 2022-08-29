@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kredit</h3>
                <div class="card-options">
                @if(Auth::user()->roles == "karyawan")
                    <a href="{{ route('kredit.create') }}" class="btn btn-sm btn-pill btn-primary">Tambah Kredit</a>
                @else
                    <!-- <a href="#" class="btn btn-sm btn-pill btn-info">Print Kredit</a> -->
                @endif
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                        <button type="button" class="close" data-dismiss="alert"></button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Anggota</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Tenor</th>
                                <th>Angsuran</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
require(['datatables', 'jquery'], function(datatable, $) {
    $('#datatable').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('kredit/get-json') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'anggota', name: 'anggota' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'nama_barang', name: 'nama_barang' },
            { data: 'nominal', name: 'nominal' },
            { data: 'tenor', name: 'tenor', orderable: false },
            { data: 'angsuran', name: 'angsuran' },
            { data: 'total_bayar', name: 'total_bayar' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
        },
        columnDefs: [
            {
                targets: [0],
                className: "text-center"
            },
            {
                targets: [2],
                className: "text-right"
            },
            {
                targets: [5],
                className: "text-center"
            }
        ]
    });
});
</script>
@endsection