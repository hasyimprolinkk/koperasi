<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Koperasi Reza Jaya</title>
    <style>
        @page{
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
        }

        .table, .bordir {
            border: 1px solid black;
            border-collapse: collapse;
        }
    
        hr.solid {
        border-top: 2px solid #000000;
        }

        #data{
            width: 100%;
        }

    </style>
    </head>

<body>

    <table>
        <tr>
            <!-- <td><img src="" width="80px" class="mr-3" alt=""></td> -->
            <td>
                <div style="text-align: center;">
                    <h1 style="margin-bottom: 15px;">Aplikasi Koperasi Reza Jaya</h1>
                </div>
            </td>
        </tr>
    </table>
    <hr class="solid">
    <div>
            <h4 style="margin-top: 4px; margin-bottom: -15px;">Laporan Kredit Barang {{ $pinjaman->member->nama }}</h4>
            <br>
        </div>
        <hr class="solid">
        <br>
        <div style="margin-top: 3px; margin-bottom: 3px;">
            <table id="data">
                <tr>
                    <td>NIK </td>
                    <td>: {{ $pinjaman->member->nik }}</td>
                    <td>Tenor</td>
                    <td>: {{ $pinjaman->tenor }} Bulan</td>
                </tr>
                <tr>
                    <td>Nama </td>
                    <td>: {{ $pinjaman->member->nama }}</td>
                    <td>Total Bayar</td>
                    <td>: {{ format_rupiah($pinjaman->total_bayar) }}</td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>: {{ $pinjaman->nama_barang }}</td>
                    <td>Angsuran Perbulan</td>
                    <td>: {{ format_rupiah($pinjaman->angsuran) }}</td>
                </tr>
                <tr>
                    <td>Harga Barang</td>
                    <td>: {{ format_rupiah($pinjaman->nominal) }}</td>
                    <td>Status</td>
                    <td>: {{ $pinjaman->status }}</span></td>
                </tr>
                <tr>
                    <td>Bunga</td>
                    <td>: {{ $pinjaman->bunga }} / Tahun</td>
                    <td>Tanggal</td>
                    <td>: {{ $pinjaman->created_at->format('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <br>
        <table style="width: 100%;" cellpadding="5" class="table" border="1">
            <thead>
                <tr>
                    <th>Nominal</th>
                    <th>Angsuran</th>
                    <th>Jatuh Tempo</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjaman->angsurans as $angsuran)
                    <tr style="text-align: center; border: 1px solid #000000;">
                        <td>{{ format_rupiah($angsuran->nominal) }}</td>
                        <td>{{ format_rupiah($angsuran->angsuran) }}</td>
                        <td>{{ date('d F Y', strtotime($angsuran->jatuh_tempo)) }}</td>
                        <td>{{$angsuran->denda == null ? 'Tidak ada' : $angsuran->denda}}</td>
                        <td>{{$angsuran->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>