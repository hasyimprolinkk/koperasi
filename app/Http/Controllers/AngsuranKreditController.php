<?php

namespace App\Http\Controllers;

use App\Models\AngsuranKredit;
use App\Models\Kredit;
use Illuminate\Http\Request;

class AngsuranKreditController extends Controller
{
    public function bayar($id)
    {
        $angsuran = AngsuranKredit::findOrFail($id);
        $angsuran->status = "sudah bayar";
        $angsuran->save();

        $cek_angsuran_belum = AngsuranKredit::where('kredit_id', $angsuran->kredit_id)->where('status', 'belum bayar')->count();
        if($cek_angsuran_belum == 0){
            $kredit = Kredit::findOrFail($angsuran->kredit_id);
            $kredit->status = "lunas";
            $kredit->save();
        } 

        return back()->with('success', 'bayar angsuran kredit berhasil disimpan.');
    }
}
