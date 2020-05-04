<?php

namespace App\Services\FinalAttendance;

use Carbon\Carbon;
use App\Kehadiran;

class KesalahanMengandung extends AbstractKesalahanCalculator
{
    const TOTAL_HOUR = 28800; //formula 9 hours in second 60*60*8
    const MINIMUM = "7:30";

    protected function calcKesalahanPetang($checkIn, $checkOut, $shift)
    {
        if (!$checkOut) {
            return Kehadiran::FLAG_KESALAHAN_NONEOUT;
        }

        if ($this->isEarly($checkIn, $checkOut, $shift)) {
            return Kehadiran::FLAG_KESALAHAN_AWAL;
        }

        return Kehadiran::FLAG_KESALAHAN_NONE;
    }

    protected function isEarly($check_in, $check_out, $shift)
    {
        $rulePunchOut = Carbon::parse($check_out->toDateString() . " " . $shift->check_out->toTimeString());

        if (!$check_in || $this->statusLewat) {
            return $this->statusAwal = $check_out->lte($rulePunchOut);
        }

        $rulePunchIn = Carbon::parse($check_in->toDateString() . " " . self::MINIMUM);

        if ($check_in->lt($rulePunchIn)) {
            return $this->statusAwal = $rulePunchIn->diffInSeconds($check_out) < self::TOTAL_HOUR;
        }

        return $this->statusAwal = $check_in->diffInSeconds($check_out) < self::TOTAL_HOUR;
    }
}
