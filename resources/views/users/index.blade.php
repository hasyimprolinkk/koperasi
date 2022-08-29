@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pegawai</h3>
                <div class="card-options">
                    <a href="{{ url('users/print') }}" class="btn btn-sm btn-pill btn-info">Print Pegawai</a>
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-pill btn-primary ml-2">Tambah Pegawai</a>
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
                    <table class="table card-table table-vcenter text-nowrap" id="datatable1">
                        <thead>
                        
                                                
                                                </div>
                                        @csrf
                                       
                                      </div>
                                     </div>
                                     </div>
                                            </div>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Roles</th>
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
    $('#datatable1').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('users/get-json') }}',
        "type": "POST",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'roles', name: 'roles' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
        },
        columnDefs: [
            {
                targets: [0],
                className: "text-center"
            }
        ]
    });
});
</script>
@endsection