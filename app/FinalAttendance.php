<?php

namespace App;

use App\Abstraction\Eventable;
use Illuminate\Support\Facades\DB;

class FinalAttendance extends Eventable
{
    protected $fillable = [
        'anggota_id',
        'basedept_id',
        'tarikh',
        'shift_id',
        'check_in',
        'check_out',
        'check_in_mid',
        'check_in_out',
        'tatatertib_flag',
        'kesalahan',
    ];

    protected $dates = [
        'tarikh',
        'check_in',
        'check_out',
        'check_in_mid',
        'check_in_out',
        'start',
        'end',
    ];

    public function __construct()
    {
        $this->setDateFormat(config('pcrs.modelDateFormat'));
    }

    public function scopeEvents($query)
    {
        return $query->select(DB::raw('CONCAT(\'IN : \', if(isnull(check_in),\'-\', date_format(check_in, \'%l:%i %p\')), "\n", \' OUT : \', if(isnull(check_out),\'-\', date_format(check_out, \'%l:%i %p\'))) as \'title\''), DB::raw('kesalahan as \'kesalahan\''), DB::raw('tatatertib_flag as \'tatatertib_flag\''), DB::raw('tarikh as \'start\''), DB::raw('tarikh as \'end\''), DB::raw('\'true\' as \'allDay\''), DB::raw('\'#1abc9c\' as \'color\''), DB::raw('\'#000\' as \'textColor\''), DB::raw('id'), DB::raw('\'' . Eventable::FINALATT . '\' as \'table_name\''));
    }

    public function eventCheckIn()
    {
        $masa = explode("\n", $this->title);
        return trim(explode(":", $masa[0], 2)[1]);
    }

    public function eventCheckOut()
    {
        $masa = explode("\n", $this->title);
        return trim(explode(":", $masa[1], 2)[1]);
    }
}
