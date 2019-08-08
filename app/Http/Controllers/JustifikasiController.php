<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Justifikasi;
use App\Http\Requests\JustifikasiRequest;

class JustifikasiController extends Controller
{
    public function store(JustifikasiRequest $request, Anggota $profil)
    {
        if ($request->input('sama') == Justifikasi::FLAG_JUSTIKASI_SAMA) {
            $justifikasiPagi = new Justifikasi;
            $justifikasiPagi->simpan([
                'basedept_id' => $profil->xtraAttr->basedept_id,
                'tarikh' => $request->input('tarikh'),
                'medan_kesalahan' => Justifikasi::FLAG_MEDAN_KESALAHAN_PAGI,
                'flag_justifikasi' => $request->input('sama'),
                'alasan' => $request->input('alasan'),
            ]);

            $justifikasiPetang = new Justifikasi;
            $justifikasiPetang->simpan([
                'basedept_id' => $profil->xtraAttr->basedept_id,
                'tarikh' => $request->input('tarikh'),
                'medan_kesalahan' => Justifikasi::FLAG_MEDAN_KESALAHAN_PETANG,
                'flag_justifikasi' => $request->input('sama'),
                'alasan' => $request->input('alasan'),
            ]);
        } else {
            $justifikasi = new Justifikasi;
            $justifikasi->simpan([
                'basedept_id' => $profil->xtraAttr->basedept_id,
                'tarikh' => $request->input('tarikh'),
                'medan_kesalahan' => $request->input('medanKesalahan'),
                'flag_justifikasi' => $request->input('sama'),
                'alasan' => $request->input('alasan'),
            ]);
        }
    }
}
