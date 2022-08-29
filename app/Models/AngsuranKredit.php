<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AngsuranKredit extends Model
{
    protected $table = 'angsuran_kredit';

    public function member()
    {
        return $this->belongsTo('App\Models\Kredit', 'kredit_id');
    }

}
