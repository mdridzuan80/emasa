<?php

namespace App\Http\Controllers;

use App\JustifikasiKehadiran;
use Illuminate\Http\Request;

class JustifikasiKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
