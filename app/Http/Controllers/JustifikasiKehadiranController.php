<?php

namespace App\Http\Controllers;

use App\JustifikasiKehadiran;
use Illuminate\Http\Request;
use App\Base\BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Transformers\Anggota as AnggotaTransformer;
use League\Fractal\Resource\Collection as FCollection;

class JustifikasiKehadiranController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //awin punya
        return $this->renderView('justifikasi.kelulusan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profil, $tarikh, $jenis)
    {
        //
        return view('dashboard.justifikasi.create', compact('tarikh', 'jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Anggota $profil, $tarikh, $jenis)
    {
        //
        $justifikasiKehadiran = new JustifikasiKehadiran();
        $justifikasiKehadiran->anggota_id = mana;
        $justifikasiKehadiran->justifikasi_tarikh = $tarikh;
        $justifikasiKehadiran->justifikasi_jenis = $jenis;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JustifikasiKehadiran  $justifikasiKehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(JustifikasiKehadiran $justifikasiKehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JustifikasiKehadiran  $justifikasiKehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(JustifikasiKehadiran $justifikasiKehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JustifikasiKehadiran  $justifikasiKehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JustifikasiKehadiran $justifikasiKehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JustifikasiKehadiran  $justifikasiKehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(JustifikasiKehadiran $justifikasiKehadiran)
    {
        //
    }
}
