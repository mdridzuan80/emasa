<?php

namespace App\Http\Controllers;

use LaporanRepository;
use App\Base\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->renderView('laporan.index');
    }

    public function harian()
    {
        return $this->renderView('laporan.harian');
    }

    public function rpcHarian(Request $request)
    {
        $rekod = LaporanRepository::laporanHarian($request->input('txtDepartmentId'), $request->input('txtTarikh'));

        return response()->json($rekod);
    }
}
