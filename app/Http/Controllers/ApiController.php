<?php

namespace App\Http\Controllers;

use App\Userinfo;
use App\Checkinout;
use App\XtraAnggota;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function storeUserinfo(Request $request)
    {
        $records = $request->json()->all();

        foreach ($records as $record) {
            $userinfo = Userinfo::firstOrCreate(['badgenumber' => $record['badgenumber'], 'ssn' => $record['ic']]);
            $userinfo->badgenumber = $record['badgenumber'];
            $userinfo->ssn = $record['ic'];
            $userinfo->name = $record['nama'];
            $userinfo->save();

            $xtraAttr = XtraAnggota::firstOrNew(['anggota_id' => $userinfo->userid]);
            $xtraAttr->anggota_id = $userinfo->userid;
            $xtraAttr->basedept_id = $record['basedept_id'];
            $xtraAttr->email = " ";
            $xtraAttr->nama = $userinfo->name;
            $xtraAttr->nokp = $userinfo->ssn;
            $xtraAttr->dept_id = $record['basedept_id'];
            $xtraAttr->save();
        }
    }

    public function storeCheckinout(Request $request)
    {
        $records = $request->json()->all();

        foreach ($records as $record) {
            $checkinout = new Checkinout;
            $checkinout->userid = $record['userid'];
            $checkinout->checktime = $record['checktime'];
            $checkinout->save();
        }
    }
}
