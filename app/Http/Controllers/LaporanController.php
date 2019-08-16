<?php

namespace App\Http\Controllers;

use LaporanRepository;
use Illuminate\Support\Arr;
use League\Fractal\Manager;
use App\Base\BaseController;
use App\Department;
use Illuminate\Http\Request;
use App\Transformers\LaporanHarianTransformer;
use League\Fractal\Resource\Collection as FCollection;

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

    public function rpcHarian(Request $request, Manager $fractal, LaporanHarianTransformer $LaporanHariantransformer)
    {
        $bahagian = Department::find($request->input('txtDepartmentId'));
        $rekod = LaporanRepository::laporanHarian($request->input('txtDepartmentId'), $request->input('txtTarikh'));

        $resource = new FCollection($rekod, $LaporanHariantransformer);
        $transform = $fractal->createData($resource);

        return response()->json(Arr::add($transform->toArray(), 'bahagian', $bahagian->deptname));
    }
}
