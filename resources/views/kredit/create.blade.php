@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Kredit</h3>
                <div class="card-options">
                    <a href="{{ route('kredit.index') }}" class="btn btn-sm btn-pill btn-secondary">Kembali</a>
                </div>
            </div>
            <form action="{{ route('kredit.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Anggota</label>
                            <div class="col-sm-10">
                                <select class="form-control{{ $errors->has('anggota') ? ' is-invalid' : '' }}" id="select2" name="anggota">
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" {!! (old('anggota') == $member->id ? "selected=\"selected\"" : "") !!}>{{ $member->nama }} - {{ $member->nik }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('anggota'))
                                    <span class="invalid-feedback">{{ $errors->first('anggota') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_barang" autocomplete="off" class="form-control{{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" value="{{ old('nama_barang') }}">
                                @if ($errors->has('nama_barang'))
                                    <span class="invalid-feedback">{{ $errors->first('nama_barang') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Harga Barang</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="text" id="nominal" name="nominal" autocomplete="off" class="form-control{{ $errors->has('nominal') ? ' is-invalid' : '' }}" value="{{ old('nominal') }}">
                                    @if ($errors->has('nominal'))
                                        <span class="invalid-feedback">{{ $errors->first('nominal') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Tenor</label>
                            <div class="col-sm-10">
                                <select class="form-control{{ $errors->has('tenor') ? ' is-invalid' : '' }}" id="select2" name="tenor">
                                    <option value="">-- Pilih Tenor --</option>
                                    <option value="1" {{ (old("tenor") == "1" ? "selected" : "") }}>1 Bulan</option>
                                    <option value="2" {{ (old('tenor') == "2" ? "selected" : "") }}>2 Bulan</option>
                                    <option value="3" {{ (old('tenor') == "3" ? "selected" : "") }}>3 Bulan</option>
                                </select>
                                @if ($errors->has('tenor'))
                                    <span class="invalid-feedback">{{ $errors->first('tenor') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" autocomplete="off" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" value="{{ old('keterangan') }}">
                                @if ($errors->has('keterangan'))
                                    <span class="invalid-feedback">{{ $errors->first('keterangan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Tambah Kredit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">

<script>
require(['jquery', 'selectize', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/id.js'], function ($, selectize, select2, select2id) {
    $(document).ready(function () {
        $('#select-beast').selectize({});
        $('#select2').select2({
            theme: "bootstrap",
            language: "id"
        });
    });
});

var rupiah = document.getElementById("nominal");
		rupiah.addEventListener("keyup", function(e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, "");
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
		}
</script>
@endsection