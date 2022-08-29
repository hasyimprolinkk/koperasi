<?php

namespace App\Http\Controllers;

use App\Models\AngsuranPinjaman;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AngsuranPinjamanController extends Controller
{
    public function index()
    {
        return view('pinjaman.angsuran.index');
    }

    public function bayar($id)
    {
        $angsuran = AngsuranPinjaman::findOrFail($id);
        $angsuran->status = "sudah bayar";
        $angsuran->save();

        $cek_angsuran_belum = AngsuranPinjaman::where('pinjaman_id', $angsuran->pinjaman_id)->where('status', 'belum bayar')->count();
        if($cek_angsuran_belum == 0){
            $pinjaman = Pinjaman::findOrFail($angsuran->pinjaman_id);
            $pinjaman->status = "lunas";
            $pinjaman->save();
        } 

        return back()->with('success', 'bayar angsuran berhasil disimpan.');
    }

    // public function show($id)
    // {
    //     $pinjaman = AngsuranPinjaman::findOrFail($id);
    //     return view('pinjaman.angsuran.show', ['pinjaman' => $pinjaman]);
    // }

    // public function jsonPinjaman()
    // {
    //     $pinjamans = AngsuranPinjaman::orderBy('id', 'desc')->get();
    //     return DataTables::of($pinjamans)
    //         ->addIndexColumn()
    //         ->addColumn('action', function($pinjaman) {
    //             return view('pinjaman.angsuran.datatables.action', compact('pinjaman'))->render();
    //         })
    //         ->addColumn('anggota', function($pinjaman) {
    //             return $pinjaman->pinjaman->member->nama;
    //         })
    //         ->addColumn('nominal', function($pinjaman) {
    //             return format_rupiah($pinjaman->nominal);
    //         })
    //         ->addColumn('angsuran', function($pinjaman) {
    //             return format_rupiah($pinjaman->angsuran);
    //         })
    //         ->addColumn('jatuh_tempo', function($pinjaman) {
    //             return date('d F Y', strtotime($pinjaman->jatuh_tempo)) . " (". Carbon::now()->diffInDays(Carbon::parse($pinjaman->jatuh_tempo)) ." hari lagi)";
    //         })
    //         ->rawColumns(['action'])
    //         ->toJson();
    // }
}
