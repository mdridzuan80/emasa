<?php

namespace App\Services;

use App\Cuti;
use App\Anggota;
use App\XtraAnggota;
use App\Parameter;
use App\Kehadiran;
use Carbon\Carbon;
use App\Kelewatan;
use App\FinalAttendance;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;


class FinalAttendanceService
{
    private $statusLewat = false;
    private $statusAwal = false;

    public function tarikhTamat($tkhTamat)
    {
        if ($tkhTamat->lt(Carbon::now()))
            return $tkhTamat;

        return Carbon::now()->subDays(1);
    }

    public function janaFinalAttendanceConsole(Collection $usersCollection, Carbon $tkhMula, Carbon $tkhTamat, Command $command)
    {
        $fTarikhTamat = clone $tkhTamat;
        $fTarikhTamat->addDay();

        $cuti = Cuti::whereBetween('tarikh', [$tkhMula, $fTarikhTamat])->get();
        $senaraiXAnggota = XtraAnggota::with('anggota', 'shifts')->when($usersCollection->isNotEmpty(), function ($query, $value) use ($usersCollection) {
            return $query->whereIn('email', $usersCollection->toArray());
        })->get();

        foreach ($senaraiXAnggota as $xAnggota) {
            $rekodKehadiran = $xAnggota->anggota->kehadiran()->rekodByMulaTamat($tkhMula, $fTarikhTamat)->orderBy('checktime')->get();
            $shifts =  $xAnggota->shifts;
            $fTarikh = clone $tkhMula;

            do {
                $shift = $shifts->first(function ($value, $key) use ($fTarikh) {
                    return Carbon::parse($value->waktu_bekerja_anggota->tkh_mula)->lte($fTarikh) && Carbon::parse($value->waktu_bekerja_anggota->tkh_tamat)->gte($fTarikh);
                });

                if ($shift) {
                    $this->personelFinalAttendance($xAnggota->anggota, $fTarikh, $shift, $cuti, $rekodKehadiran);
                }
            } while ($fTarikh->addDay()->lte($tkhTamat));
        }
    }

    public function janaPersonelFinalAttendance(Anggota $profil, Carbon $tkhMula, Carbon $tkhTamat, $shift)
    {
        $cuti = Cuti::whereBetween('tarikh', [$tkhMula, $tkhTamat])->get();
        $rekodKehadiran = $profil->kehadiran()->rekodByMulaTamat($tkhMula, $tkhTamat)->orderBy('checktime')->get();
        $fTarikh = clone $tkhMula;

        do {
            $this->personelFinalAttendance($profil, $fTarikh, $shift, $cuti, $rekodKehadiran);
        } while ($fTarikh->addDay()->lte($tkhTamat));
    }

    public function personelFinalAttendance(Anggota $profil, Carbon $tarikh, $shift, $cuti, $rekodKehadiran)
    {
        $preData = $this->preDataFinalAttendance($profil, $tarikh, $shift, $cuti, $rekodKehadiran);

        $this->janaFinalAttendance($profil, $preData, $shift);

        if ($this->statusLewat) {
            $this->tambahLewat($profil, $preData, $shift, Kelewatan::FLAG_NON_SMS);
            $this->statusLewat = false;
        }
    }

    private function preDataFinalAttendance(Anggota $profil, Carbon $tarikh, $shift, $cuti, $rekodKehadiran)
    {
        return (object) [
            'anggota_id' => $profil->userid,
            'tarikh' => $tarikh,
            'check_in' => $check_in = $this->punch($rekodKehadiran, $tarikh, $cuti, Kehadiran::PUNCH_IN, $profil->ZIP),
            'check_out' => $check_out = $this->punch($rekodKehadiran, $tarikh, $cuti, Kehadiran::PUNCH_OUT, $profil->ZIP),
            'check_in_mid' => $check_min = $this->punch($rekodKehadiran, $tarikh, $cuti, Kehadiran::PUNCH_MIN, $profil->ZIP),
            'check_out_mid' => $check_mout = $this->punch($rekodKehadiran, $tarikh, $cuti, Kehadiran::PUNCH_MOUT, $profil->ZIP),
            'tatatertib_flag' => $this->getFlag($profil, $tarikh, $check_in, $check_out, $check_min, $check_mout, $cuti, $shift),
            'shift_id' => $shift->id,
        ];
    }

    private function punch($rekodKehadiran, Carbon $tarikh, $cuti, $jnsPunch, $jnsUser)
    {
        $closureFilter = function ($value, $key) use ($tarikh, $cuti, $jnsPunch, $jnsUser) {
            switch ($jnsPunch) {
                case Kehadiran::PUNCH_IN:
                    if ($this->isCuti($tarikh, $cuti)) {
                        return $value->checktime->gte($tarikh->copy()->addHours(4)) &&
                            $value->checktime->lt($tarikh->copy()->addDays(1)->addHours(4)) &&
                            $value->checktype != '1' && $value->checktype != 'i';
                    } else {
                        return $value->checktime->gte($tarikh->copy()->addHours(4)) &&
                            $value->checktime->lt($tarikh->copy()->addHours(13)) &&
                            $value->checktype != '1' && $value->checktype != 'i';
                    }

                    break;

                case Kehadiran::PUNCH_OUT:
                    if ($this->isCuti($tarikh, $cuti)) {
                        return $value->checktime->gte($tarikh->copy()->addHours(4)) &&
                            $value->checktime->lt($tarikh->copy()->addDays(1)->addHours(4)) &&
                            $value->checktype != '1' && $value->checktype != 'i';
                    } else {
                        return $value->checktime->gte($tarikh->copy()->addHours(13)) &&
                            $value->checktime->lt($tarikh->copy()->addDays(1)->addHours(4)) &&
                            $value->checktype != '1' && $value->checktype != 'i';
                    }

                    break;

                case Kehadiran::PUNCH_MIN:
                    if ($jnsUser) {
                        return $value->checktime->gte($tarikh->copy()->addHours(4)) &&
                            $value->checktime->lt($tarikh->copy()->addDays(1)->addHours(4)) &&
                            $value->checktype == '1';
                    }

                    break;

                case Kehadiran::PUNCH_MOUT:
                    if ($jnsUser) {
                        return $value->checktime->gte($tarikh->copy()->addHours(4)) &&
                            $value->checktime->lt($tarikh->copy()->addDays(1)->addHours(4)) &&
                            $value->checktype == 'i';
                    }

                    break;
            }
        };

        $data = $rekodKehadiran->filter($closureFilter);

        if ($data->isNotEmpty()) {
            if ($jnsPunch == Kehadiran::PUNCH_IN || $jnsPunch == Kehadiran::PUNCH_MIN) {
                return $data->first()->checktime;
            }

            if ($jnsPunch == Kehadiran::PUNCH_OUT || $jnsPunch == Kehadiran::PUNCH_MOUT) {
                return $data->last()->checktime;
            }
        }

        return null;
    }

    public function getKesalahan($profil, $tarikh, $checkIn, $checkOut, $checkMin, $checkMout, $cuti, $shift)
    {
        $kesalahan = [];

        if ($this->isCuti($tarikh, $cuti)) {
            return json_encode($kesalahan);
        }

        if ($profil->ZIP) {
            if (is_null($checkIn)) {
                $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEIN;
            }

            if (is_null($checkOut)) {
                $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEOUT;
            }

            if (is_null($checkMin)) {
                $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEMIN;
            }

            if (is_null($checkMout)) {
                $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEMOUT;
            }

            if ($this->isLate($checkIn, $shift)) {
                $kesalahan[] = Kehadiran::FLAG_KESALAHAN_LEWAT;
            }

            return json_encode($kesalahan);
        }

        if (is_null($checkIn)) {
            $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEIN;
        }

        if (is_null($checkOut)) {
            $kesalahan[] = Kehadiran::FLAG_KESALAHAN_NONEOUT;
        }

        return json_encode($kesalahan);
    }

    public function getFlag($profil, $tarikh, $checkIn, $checkOut, $checkMin, $checkMout, $cuti, $shift)
    {
        if (!$this->isCuti($tarikh, $cuti)) {
            if ($profil->ZIP) {
                if ((is_null($checkIn) || is_null($checkOut)) && (is_null($checkMin) || is_null($checkMout)) && $this->isLate($checkIn, $shift)) {
                    return Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB;
                }
            } else {
                if (is_null($checkIn) || $this->isLate($checkIn, $shift) || is_null($checkOut) || $this->isEarly($checkIn, $checkOut, $shift)) {
                    return Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB;
                }
            }
        }

        return Kehadiran::FLAG_TATATERTIB_CLEAR;
    }

    public function isCuti($tarikh, $cuti)
    {
        return $cuti->contains(function ($item, $key) use ($tarikh) {
            return $item->tarikh->eq($tarikh);
        }) ||
            $tarikh->dayOfWeek == Carbon::SATURDAY ||
            $tarikh->dayOfWeek == Carbon::SUNDAY;
    }

    public function isLate($check_in, $shift)
    {
        if (!$check_in) {
            return $this->statusLewat = false;
        }

        $rulePunchIn = Carbon::parse($check_in->toDateString() . " " . $shift->check_in->toTimeString());
        $paramBenarLewat = (int) Parameter::where('kod', 'P_BENAR_LEWAT')->first()->nilai;

        return $this->statusLewat = $check_in->gte($rulePunchIn->addMinutes($paramBenarLewat));
    }

    public function isEarly($check_in, $check_out, $shift)
    {
        if (!$check_in || $this->statusLewat) {
            return $this->statusAwal = $check_out->gte(Carbon::parse($check_out->toDateString() . " " . $shift->check_out->toTimeString()));
        } else if ($check_out) {
            return $this->statusAwal = $check_in->diffInMinutes(Carbon::parse($check_out->toDateString() . " " . $shift->check_out->toTimeString())) >= (60 * 9);
        }
    }

    public function janaFinalAttendance($profil, $preData, $shift)
    {
        FinalAttendance::updateOrCreate(['anggota_id' => $preData->anggota_id, 'tarikh' => $preData->tarikh], (array) $preData);
    }

    public function tambahLewat($profil, $preData, $shift, $smsFlag)
    {
        $lewat = new Kelewatan;
        $lewat->anggota_id = $profil->userid;
        $lewat->shift_id = $shift->id;
        $lewat->check_in = $preData->check_in;
        $lewat->send_sms_flag = $smsFlag;

        return $lewat->save();
    }

    public function hapusLewat($profil, $tkhMula, $tkhTamat)
    {
        return Kelewatan::where('anggota_id', $profil->userid)
            ->where('check_in', '>=', $tkhMula)
            ->where('check_in', '<=', $tkhTamat)
            ->delete();
    }
}
