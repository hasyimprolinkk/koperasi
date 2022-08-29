<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }

    public function angsurans()
    {
        return $this->hasMany('App\Models\AngsuranPinjaman', 'pinjaman_id');
    }
}
