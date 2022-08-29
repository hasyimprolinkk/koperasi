@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Pinjaman Terbaru Hari Ini</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Anggota</th>
                            <th>Tanggal</th>
                            <th>Tenor</th>
                            <th>Nominal Pinjaman</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pinjaman as $pinjam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>{{ $pinjam->member->nama }}</div>
                                    <div class="small text-muted">
                                        NIK: {{ $pinjam->member->nik }}
                                    </div>
                                </td>
                                <td>{{ $pinjam->created_at->diffForHumans() }}</td>
                                <td>{{ $pinjam->tenor }} Bulan</td>
                                <td>{{ format_rupiah($pinjam->nominal) }}</td>
                                <td>{{ format_rupiah($pinjam->total_bayar) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Kredit Barang Terbaru Hari Ini</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Anggota</th>
                            <th>Waktu</th>
                            <th>Nama Barang</th>
                            <th>Nominal Pinjaman</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kredit as $kre)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>{{ $kre->member->nama }}</div>
                                    <div class="small text-muted">
                                        NIK: {{ $kre->member->nik }}
                                    </div>
                                </td>
                                <td>{{ $kre->created_at->diffForHumans() }}</td>
                                <td>{{ $kre->nama_barang }}</td>
                                <td class="text-right">{{ format_rupiah($kre->nominal) }}</td>
                                <td class="text-right">{{ format_rupiah($kre->total_bayar) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
