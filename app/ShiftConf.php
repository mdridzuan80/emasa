<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShiftConf extends Model
{
    const NORMAL = 'NORMAL';
    const PUASA = 'PUASA';
    const MENGANDUNG = 'MENGANDUNG';

    protected $table = 'shift_confs';

    protected $fillable = ['anggota_id', 'puasa_id', 'jenis', 'pilihan', 'tkh_mula', 'tkh_tamat'];

    public function scopeTahunSemasa($query)
    {
        $tkhMula = Carbon::now()->year . "-01-01 00:00:00";
        $tkhTamat = Carbon::now()->year + 1 . "-01-01 00:00:00";

        return $this->where('tkh_mula', '>=', $tkhMula)->orWhere('tkh_tamat', '>', $tkhTamat);
    }
}
