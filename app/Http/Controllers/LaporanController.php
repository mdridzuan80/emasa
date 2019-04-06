<?php

namespace App\Http\Controllers;

use App\Facades\FinalAttendanceFacade;
use App\FinalAttendance;
use App\Laporan;
use App\Role;
use App\Base\BaseController;
use Illuminate\Http\Request;
use App\Anggota;
use App\Department;
use PDF;


class LaporanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    public function index()
    {

       return $this->renderView('laporan.index', compact('harian'));
    }

    //pdf https://itsolutionstuff.com/post/laravel-57-generate-pdf-from-html-exampleexample.html
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('pdf.harian-pdf', $data);
        return $pdf->download('harian.pdf');
    }

    public function rpcFlowHarianShow(Department $department, Request $request)
    {
        $senAnggota = Anggota::with('justifikasi')->where('DEFAULTDEPTID', $department->id)->get();

//        dd($department->DEPTID);
//        $senAnggota = $department->DEPTIDAnggota::where('DEFAULTDEPTID', $department->DEPTID)->get();
//        dd($senAnggota);
//
//        return response()->json($senAnggota->toArray());
        return view('laporan.list_harian', compact('senAnggota'));
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function showListHarian(Request $request)
    {
        $anggota_id = '1';
        $harian = FinalAttendance::where('anggota_id', $anggota_id)->get();
        return $this->renderView('laporan.list_harian', compact('harian'));
    }

    public function showBulanan(Request $request)
    {
        $data = ['title' => 'Welcome to emasa.com'];
        $pdf = PDF::loadView('pdf.bulanan-pdf', $data);
        return $pdf->download('bulanan.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }


}
