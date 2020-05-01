<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftConf extends Model
{
    const NORMAL = 'NORMAL';
    const PUASA = 'PUASA';
    const MENGANDUNG = 'MENGANDUNG';

    protected $table = 'shift_confs';

    protected $fillable = ['anggota_id', 'puasa_id', 'jenis', 'pilihan'];
}
