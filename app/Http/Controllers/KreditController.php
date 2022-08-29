<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKredit;
use App\Models\AngsuranKredit;
use App\Models\Kredit;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use PDF;

class KreditController extends Controller
{
    public function index()
    {
        return view('kredit.index');
    }

    public function create()
    {
        $members = Member::orderBy('nama', 'asc')->get();

        return view('kredit.create', ['members' => $members]);
    }

    public function store(StoreKredit $request)
    {
        DB::transaction(function () use ($request) {
            // Insert into deposit
            $bunga = intval(extract_numbers($request->nominal)) * (3/100) * (30/360) * intval($request->tenor);
            $total_bayar = intval(extract_numbers($request->nominal)) + round($bunga);
            $angsuran = round($total_bayar / $request->tenor);

            $kredit = new Kredit;
            $kredit->anggota_id = $request->anggota;
            $kredit->nama_barang = $request->nama_barang;
            $kredit->nominal = extract_numbers($request->nominal);
            $kredit->tenor = $request->tenor;
            $kredit->angsuran = $angsuran;
            $kredit->total_bayar = $total_bayar;
            $kredit->keterangan = $request->keterangan;
            $kredit->save();

            $tanggal = ['30', '60', '90'];
            for ($i=0; $i < intval($request->tenor); $i++) { 
                $angsur = new AngsuranKredit;
                $angsur->kredit_id = $kredit->id;
                $angsur->nominal = $total_bayar;
                $angsur->angsuran = $angsuran;
                $angsur->jatuh_tempo = Carbon::now()->addDays($tanggal[$i])->format('Y-m-d');
                $angsur->save();
            }

        });

        return redirect()->route('kredit.index')->with('success', 'Data Kredit berhasil disimpan.');
    }

    public function show($id)
    {
        $kredit = Kredit::findOrFail($id);
        return view('kredit.show', ['kredit' => $kredit]);
    }

    public function cetak($id)
    {
        $pinjaman = Kredit::findOrFail($id);
        $pdf = PDF::loadview('kredit.print', compact('pinjaman'))->setPaper('a4', 'landscape');
        return $pdf->download($pinjaman->member->nama .'_kredit.pdf');
    }

    public function jsonKredit()
    {
        $kredits = Kredit::orderBy('id', 'desc')->get();
        return DataTables::of($kredits)
            ->addIndexColumn()
            ->addColumn('action', function($kredit) {
                return view('kredit.datatables.action', compact('kredit'))->render();
            })
            ->addColumn('anggota', function($kredit) {
                return $kredit->member->nama;
            })
            ->addColumn('tanggal', function($kredit) {
                return $kredit->created_at->format('d F Y H:i');
            })
            ->addColumn('nominal', function($kredit) {
                return format_rupiah($kredit->nominal);
            })
            ->addColumn('tenor', function($kredit) {
                return $kredit->tenor . " Bulan";
            })
            ->addColumn('angsuran', function($kredit) {
                return format_rupiah($kredit->angsuran);
            })
            ->addColumn('total_bayar', function($kredit) {
                return format_rupiah($kredit->total_bayar);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
