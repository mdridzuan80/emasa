<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justifikasi extends Model
{
    const FLAG_KELULUSAN_MOHON = "MOHON";
    const FLAG_KELULUSAN_LULUS = "LULUS";
    const FLAG_KELULUSAN_TOLAK = "BATAL";

    const FLAG_MEDAN_KESALAHAN_PAGI = "PAGI";
    const FLAG_MEDAN_KESALAHAN_PETANG = "PETANG";

    const FLAG_JUSTIKASI_SAMA = "SAMA";
    const FLAG_JUSTIKASI_TIDAK_SAMA = "XSAMA";

    const PUNCH_OUT = "OUT";
    const PUNCH_MIN = "MIN";
    const PUNCH_MOUT = "MOUT";

    public function __construct()
    {
        $this->table = 'justifikasi';
    }

    public function simpan(array $data)
    {
        $this->basedept_id = $data['basedept_id'];
        $this->tarikh = $data['tarikh'];
        $this->medan_kesalahan = $data['medan_kesalahan'];
        $this->flag_justifikasi = $data['flag_justifikasi'];
        $this->keterangan = $data['alasan'];
        $this->save();
    }
}
