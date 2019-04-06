<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Department;
use League\Fractal\Manager;
use App\Base\BaseController;
use Illuminate\Http\Request;
use App\Transformers\FlowBahagianTransformer;
use League\Fractal\Resource\Item as FractalItem;

//class KelulusanController extends Controller
class KelulusanController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->renderView('kelulusan.index');
    }

    public function rpcFlowBahagianShow(Department $department, Manager $fractal, FlowBahagianTransformer $flowBahagianTransformer)
    {
        $resource = new FractalItem($department->flow, $flowBahagianTransformer);
        $transform = $fractal->createData($resource);

        return response()->json($transform->toArray());
    }

    public function rpcFlowSenaraiShow(Department $department, Request $request)
    {
        $senAnggota = Anggota::with('justifikasi')->where('DEFAULTDEPTID', $department->id)->get();

//        dd($department->DEPTID);
//        $senAnggota = $department->DEPTIDAnggota::where('DEFAULTDEPTID', $department->DEPTID)->get();
//        dd($senAnggota);
//
//        return response()->json($senAnggota->toArray());
        return view('kelulusan.anggota_grid', compact('senAnggota'));
    }

//    public function rpcFlowBahagianUpdate(Department $department, Request $request)
//    {
//        $department->updateFlow($request);
//    }
}
