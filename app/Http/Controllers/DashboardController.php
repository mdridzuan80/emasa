<?php

namespace App\Http\Controllers;

use App\Role;
use App\Base\BaseController;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\JustifikasiKehadiran;
use App\FinalAttendance;
use App\Kelewatan;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->session()->get('perananSemasa') === Role::PENGGUNA) {
            return $this->renderView('dashboard.pengguna.index');
        }

        return $this->renderView('dashboard.index');
    }

    public function dashboard(Request $request)
    {
            $current_month = date('M');

            //sendiri punya - dashboard atas
            //$mylate = Kelewatan::where('anggota_id', $id)->whereMonth('tarikh', $current_month)->count();
            //$myjustification = FinalAttendance::where('anggota_id', $id)->where('tatatertib_flag', 'TS')->count();
            //$mycutirehat = JustifikasiKehadiran::where('justifikasi_keterangan', 'like', '%Cuti Rehat%')->count();

            //justifikasi
            $finalattendances = FinalAttendance::where('tatatertib_flag', 'TS')->get();
            
            //jabatan
            return $this->renderView('dashboard.dashboard.index', compact('finalattendances'));
    }
}
