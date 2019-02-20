<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class JustifikasiKehadiran extends Model
{
    //
    const BENGKEL_YA = 'YA';
    const BENGKEL_TIDAK = 'TIDAK';

    //awin buat relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //awin buat
    public function getJustifikasi($justifikasis)
    {
        $justifikasis = where('tatatertib_flag', 'M')->all();
    }

}
