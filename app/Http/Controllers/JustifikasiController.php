<?php

namespace App\Http\Controllers;

use Auth;
use Flow;
use App\Anggota;
use App\Justifikasi;
use App\Base\BaseController;
use App\FinalAttendance;
use App\Flow as AppFlow;
use Illuminate\Http\Request;
use App\Jobs\JustifikasiSendingEmailJob;
use App\Http\Requests\JustifikasiRequest;


class JustifikasiController extends BaseController
{
    public function index()
    {
        $permohonan = Auth::user()->xtraAnggota->kelulusanJustifikasi()->get();

        return $this->renderView('kelulusan.index', compact('permohonan'));
    }

    public function rpcStore(JustifikasiRequest $request, Anggota $profil)
    {
        if (Flow::pelulus($profil)) {

            $justifikasi = [
                'finalattendance_id' => $request->input('finalAttendance'),
                'basedept_id' => $profil->xtraAttr->basedept_id,
                'tarikh' => $request->input('tarikh'),
                'flag_justifikasi' => $request->input('sama'),
                'alasan' => $request->input('alasan'),
                'pelulus_id' => Flow::pelulus($profil)->xtraAttr->anggota_id,
            ];

            if ($request->input('sama') == Justifikasi::FLAG_JUSTIKASI_SAMA) {
                $justifikasiPagi = new Justifikasi;
                $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PAGI;
                $justifikasiPagi->simpan($justifikasi);

                $justifikasiPetang = new Justifikasi;
                $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PETANG;
                $justifikasiPetang->simpan($justifikasi);

                dispatch(new JustifikasiSendingEmailJob($profil, $request->input('finalAttendance'), $request->input('medanKesalahan')));

                return response('Ok', 200);
            }

            $justifikasiA = new Justifikasi;
            $justifikasi['medan_kesalahan'] = $request->input('medanKesalahan');
            $justifikasiA->simpan($justifikasi);

            dispatch(new JustifikasiSendingEmailJob($profil, $request->input('finalAttendance'), $request->input('medanKesalahan')));

            return response('Ok', 200);
        }

        return response('Sila semak konfigurasi flow anggota atau ketua jabatan', 422);
    }

    public function rpcUpdate(Justifikasi $justifikasi, Request $request)
    {
        $justifikasi->flag_kelulusan = $request->input('status');
        $justifikasi->save();
    }

    //tambah baru
    public function pkpbCreate(Request $request, Anggota $profil)
    {

        $anggota = Auth::user($profil)->xtraAnggota;
        // $finalAttendance = FinalAttendance::where('anggota_id', '=', $anggota->anggota_id)->get();
        // ->where('tarikh', '=', '2020-10-19')->first();

        // dd($finalAttendance->id);


        $request->all();
        $perPage = 10;

        $years = Justifikasi::years();
        $year = $request->input('tahun', now()->year);

        $pkpb = Justifikasi::join('final_attendances', 'justifikasi.final_attendance_id', '=', 'final_attendances.id')
            ->whereYear('justifikasi.tarikh', $year)
            ->where('justifikasi.flag_justifikasi', 'PKP')
            ->where('justifikasi.medan_kesalahan', 'PAGI')
            ->where('final_attendances.anggota_id', $anggota->anggota_id)
            ->select('justifikasi.*', 'justifikasi.id as id')
            ->paginate($perPage);

			if (!empty($request->input('tahun'))) {
            return $this->renderView('Pkpb.show')->with(array('years' => $years, 'year' => $year, 'pkpb' => $pkpb));
        }
        return $this->renderView('Pkpb.index')->with(array('years' => $years, 'year' => $year, 'pkpb' => $pkpb));
    }
    

    public function pkpbStore(Justifikasi $justifikasi, Request $request, Anggota $profil)
    {

        $anggota = Auth::user($profil)->xtraAnggota;
        if ($request->input('pkpId') != null) {

            $justifikasi = Justifikasi::firstOrNew(['tarikh' => $request->input('txtTarikhPkp')]);

            $justifikasi->tarikh = $request->input('txtPerihal');
        } else {


            $finalAttendance = FinalAttendance::where('anggota_id', '=', $anggota->anggota_id)
                ->where('tarikh', '=', $request->input('txtTarikhPkp'))->first();


            // dd($finalAttendance);
            $justifikasi = [
                'finalattendance_id' => $finalAttendance->id,
                'basedept_id' => $anggota->basedept_id,
                'tarikh' => $request->input('txtTarikhPkp'),
                'flag_justifikasi' => 'PKP',
                'flag_kelulusan' => 'LULUS',

                'alasan' => $request->input('txtPerihal'),
                'pelulus_id' => null,
            ];
            if ($justifikasi['flag_justifikasi'] != Justifikasi::FLAG_JUSTIKASI_SAMA) {
                $justifikasiPagi = new Justifikasi;
                $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PAGI;

                $justifikasiPagi->pkpSimpan($justifikasi);

                $justifikasiPetang = new Justifikasi;
                $justifikasi['medan_kesalahan'] = Justifikasi::FLAG_MEDAN_KESALAHAN_PETANG;

                $justifikasiPetang->pkpSimpan($justifikasi);



                return response('Ok', 200);
            }
        }

        $justifikasiA = new Justifikasi;
        $justifikasiA->pkpSimpan($justifikasi);
    }

    public function pkpbDestroy(Request $request)
    {
        $pkp = Justifikasi::find($request->input('pkpId'))->where('final_attendance_id', $request->input('finalAttendanceId'));
        $pkp->delete();
    }
}
