<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Base\BaseController;
use Illuminate\Http\Request;


class PengurusanController extends BaseController
{
     public function index()
    {


    	$anggota = Anggota::user();

        return $this->renderView('pengurusan.index')->with('anggota',$anggota);
    }
}
