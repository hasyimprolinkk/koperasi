<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePinjaman;
use App\Models\AngsuranPinjaman;
use App\Models\Member;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use PDF;

class PinjamanController extends Controller
{
    public function index()
    {
        return view('pinjaman.index');
    }

    public function create()
    {
        $members = Member::orderBy('nama', 'asc')->get();

        return view('pinjaman.create', ['members' => $members]);
    }

    public function store(StorePinjaman $request)
    {
        DB::transaction(function () use ($request) {
            // Insert into deposit
            $bunga = intval(extract_numbers($request->nominal)) * (3/100) * (30/360) * intval($request->tenor);
            $total_bayar = intval(extract_numbers($request->nominal)) + round($bunga);
            $angsuran = round($total_bayar / $request->tenor);

            $pinjam = new Pinjaman;
            $pinjam->anggota_id = $request->anggota;
            $pinjam->nominal = extract_numbers($request->nominal);
            $pinjam->tenor = $request->tenor;
            $pinjam->angsuran = $angsuran;
            $pinjam->total_bayar = $total_bayar;
            $pinjam->keterangan = $request->keterangan;
            $pinjam->save();

            $tanggal = ['30', '60', '90'];
            for ($i=0; $i < intval($request->tenor); $i++) { 
                $angsur = new AngsuranPinjaman;
                $angsur->pinjaman_id = $pinjam->id;
                $angsur->nominal = $total_bayar;
                $angsur->angsuran = $angsuran;
                $angsur->jatuh_tempo = Carbon::now()->addDays($tanggal[$i])->format('Y-m-d');
                $angsur->save();
            }

        });

        return redirect()->route('pinjaman.index')->with('success', 'Data Pinjaman berhasil disimpan.');
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        return view('pinjaman.show', ['pinjaman' => $pinjaman]);
    }

    public function cetak($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pdf = PDF::loadview('pinjaman.print', compact('pinjaman'))->setPaper('a4', 'landscape');
        return $pdf->download($pinjaman->member->nama .'_pinjaman.pdf');
    }

    public function jsonPinjaman()
    {
        $pinjamans = Pinjaman::orderBy('id', 'desc')->get();
        return DataTables::of($pinjamans)
            ->addIndexColumn()
            ->addColumn('action', function($pinjaman) {
                return view('pinjaman.datatables.action', compact('pinjaman'))->render();
            })
            ->addColumn('anggota', function($pinjaman) {
                return $pinjaman->member->nama;
            })
            ->addColumn('tanggal', function($pinjaman) {
                return $pinjaman->created_at->format('d F Y H:i');
            })
            ->addColumn('nominal', function($pinjaman) {
                return format_rupiah($pinjaman->nominal);
            })
            ->addColumn('tenor', function($pinjaman) {
                return $pinjaman->tenor . " Bulan";
            })
            ->addColumn('angsuran', function($pinjaman) {
                return format_rupiah($pinjaman->angsuran);
            })
            ->addColumn('total_bayar', function($pinjaman) {
                return format_rupiah($pinjaman->total_bayar);
            })
            ->rawColumns(['action'])
            ->toJson();
    }

}
