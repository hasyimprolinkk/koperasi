<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    protected $table = 'kredit';

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }

    public function angsurans()
    {
        return $this->hasMany('App\Models\AngsuranKredit', 'kredit_id');
    }
}
