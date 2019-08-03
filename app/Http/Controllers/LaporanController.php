<?php

namespace App\Http\Controllers;

use App\Base\BaseController;
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
        //
        $ujian = [
            ['nama'=>'Md Ridzuan bin Mohammad Latiah', 'shift'=>'FLEXI', 'checkin'=>'8:50 AM'],
        ];
        
        return response()->json($ujian);
    }
}
