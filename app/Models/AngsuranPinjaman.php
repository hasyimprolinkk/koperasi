<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AngsuranPinjaman extends Model
{
    protected $table = 'angsuran_pinjaman';

    public function pinjaman()
    {
        return $this->belongsTo('App\Models\Pinjaman', 'pinjaman_id');
    }
}
