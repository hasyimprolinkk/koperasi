@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pegawai</h3>
                <div class="card-options">
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                    <a class="btn btn-sm btn-pill btn-primary ml-2" href="{{ route('users.edit', $user->id) }}">Ubah</a>
                </div>
            </div>
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">E-Mail</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Roles</td>
                        <td>{{ $user->roles }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
