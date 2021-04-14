<?php

namespace App\Repositories;

use DB;
use App\Cuti;
use App\Anggota;
use App\Kehadiran;

class LaporanRepository
{
    public static function laporanHarian($department_id, $tarikh)
    {
        return DB::table('xtra_userinfo')
            ->select('xtra_userinfo.anggota_id', 'userinfo.badgenumber', 'xtra_userinfo.nama', 'shifts.name as shift_name', 'final_attendances.check_in', 'final_attendances.check_out', 'final_attendances.kesalahan', 'final_attendances.tatatertib_flag')
            ->join('userinfo', 'userinfo.userid', '=', 'xtra_userinfo.anggota_id')
            ->leftJoin('final_attendances', 'final_attendances.anggota_id', '=', 'xtra_userinfo.anggota_id')
            ->leftJoin('shifts', 'shifts.id', '=', 'final_attendances.shift_id')
            ->where('xtra_userinfo.basedept_id', $department_id)
            ->where(function ($query) use ($tarikh) {
                $query->where('final_attendances.tarikh', $tarikh)
                    ->orWhere('final_attendances.tarikh', null);
            })->orderBy('xtra_userinfo.nama')
            ->get();
    }

    public function laporanBulanan(Anggota $profil, $mula, $tamat)
    {
        $checkinout = collect(($profil->finalKehadiran()->events()->getEventBetween([$mula, $tamat])->get())->load('cuti')->toArray());
        $cuti = Cuti::events()->getEventBetween([$mula, $tamat])->get()->toArray();
        $acara = $profil->acara()->events()->getByDateRange($mula, $tamat)->get();

        $events = $checkinout->merge($cuti)->merge($acara);

        if ($checkIn = optional($profil->kehadiran()->events()->whereBetween('CHECKTIME', [today()->addHours(4), today()->addHours(13)])->first())->toArray()) {
            $events = $events->push($checkIn);
        } else {
            $events->push(Kehadiran::itemEventableNone());
        }

        return $events;
    }

}
