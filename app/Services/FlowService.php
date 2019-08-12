<?php

namespace App\Services;

use \App\Flow;
use \App\Anggota;
use App\XtraAnggota;
use App\Abstraction\Flowable;

class FlowService
{
    public function flowAnggota(Anggota $profil)
    {
        if ($flowAnggota = $this->getFlowAnggota($profil)) {
            return $this->getFlow($flowAnggota);
        }

        if ($flowBahagian = $profil->xtraAttr->baseDepartment->flow) {
            return $this->getFlow($flowBahagian);
        }

        return Flow::BIASA;
    }

    public function getFlowAnggota($profil)
    {
        $flowAnggota = $profil->flow;

        if ($flowAnggota && $flowAnggota->flow != Flow::INHERIT) {
            return $this->getFlow($flowAnggota);
        }

        return $flowAnggota;
    }

    public function getFlow(Flowable $flow)
    {
        return $flow->flag;
    }

    public function pelulus($profil)
    {
        if ($this->flowAnggota($profil) == Flow::KETUA) {
            return XtraAnggota::where('basedept_id', $profil->xtraAttr->basedept)->anggota;
        }

        return $profil->pegawaiYangMenilai()->where('pegawai_flag', 1)->first()->penilai;
    }
}
