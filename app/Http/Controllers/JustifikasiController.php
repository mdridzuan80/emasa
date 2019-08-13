<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Justifikasi;
use App\Jobs\JustifikasiSendingEmailJob;
use App\Http\Requests\JustifikasiRequest;

class JustifikasiController extends Controller
{
    public function store(JustifikasiRequest $request, Anggota $profil)
    {
        $justifikasi = [
            'finalattendance_id' => $request->input('finalAttendance'),
            'basedept_id' => $profil->xtraAttr->basedept_id,
            'tarikh' => $request->input('tarikh'),
            'flag_justifikasi' => $request->input('sama'),
            'alasan' => $request->input('alasan'),
        ];

        if ($request->input('sama') == Justifikasi::FLAG_JUSTIKASI_SAMA) {
            $justifikasiPagi = new Justifikasi;
            $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PAGI;
            $justifikasiPagi->simpan($justifikasi);

            $justifikasiPetang = new Justifikasi;
            $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PETANG;
            $justifikasiPetang->simpan($justifikasi);

            dispatch(new JustifikasiSendingEmailJob($profil, $request->input('finalAttendance'), $request->input('medanKesalahan')));
        }

        $justifikasiA = new Justifikasi;
        $justifikasi['medan_kesalahan'] = $request->input('medanKesalahan');
        $justifikasiA->simpan($justifikasi);

        dispatch(new JustifikasiSendingEmailJob($profil, $request->input('finalAttendance'), $request->input('medanKesalahan')));
    }
}
