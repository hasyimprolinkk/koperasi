@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kredit</h3>
                <div class="card-options">
                    <a href="{{ url('kredit/print', $kredit->id) }}" class="btn btn-sm btn-pill btn-primary">Print</a>
                    <a href="{{ route('kredit.index') }}" class="btn btn-sm btn-pill btn-secondary ml-2">Kembali</a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                    <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    <button type="button" class="close" data-dismiss="alert"></button>
                    {{ session('success') }}
                </div>
            @endif
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td style="width: 25%;" class="text-muted">Anggota</td>
                        <td>
                            <a href="{{ route('members.show', $kredit->anggota_id) }}" target="_blank">{{ $kredit->member->nama }} - {{ $kredit->member->nik }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nama Barang</td>
                        <td>{{ $kredit->nama_barang }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga Barang</td>
                        <td>{{ format_rupiah($kredit->nominal) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bunga</td>
                        <td>{{ $kredit->bunga }} / Tahun</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tenor</td>
                        <td>{{ $kredit->tenor }} Bulan</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Angsuran Perbulan</td>
                        <td>{{ format_rupiah($kredit->angsuran) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Bayar</td>
                        <td>{{ format_rupiah($kredit->total_bayar) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        @if($kredit->status == "belum lunas")
                            <td><span class="btn btn-sm btn-danger">{{ $kredit->status }}</span></td>
                            @else
                            <td><span class="btn btn-sm btn-success">{{ $kredit->status }}</span></td>
                        @endif
                    </tr>
                    <tr>
                        <td class="text-muted">Keterangan</td>
                        <td>{{ $kredit->keterangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>{{ $kredit->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
        <table class="table card-table">
                <thead>
                    <tr>
                        <th>Nominal</th>
                        <th>Angsuran</th>
                        <th>Jatuh Tempo</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kredit->angsurans as $angsuran)
                        <tr>
                            <td>{{ format_rupiah($angsuran->nominal) }}</td>
                            <td>{{ format_rupiah($angsuran->angsuran) }}</td>
                            <td>{{ date('d F Y', strtotime($angsuran->jatuh_tempo)) }}</td>
                            <td>{{$angsuran->denda == null ? 'Tidak ada' : $angsuran->denda}}</td>
                            <td>
                                @if($angsuran->status == "belum bayar")
                                    <span class="btn btn-sm btn-danger">{{$angsuran->status}}</span>
                                    @else
                                    <span class="btn btn-sm btn-info">{{$angsuran->status}}</span>
                                @endif
                            </td>
                            <td>
                            @if(Auth::user()->roles == "karyawan")
                                @if($angsuran->status == "belum bayar")
                                    <a class="btn btn-sm btn-success" onclick="return confirm('Bayar Angsuran kredit?')" href="{{ url('angsurankredit/bayar', $angsuran->id) }}">Bayar</a>
                                @endif
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
