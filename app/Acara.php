<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Abstraction\Eventable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acara extends Eventable
{
    use SoftDeletes;

    protected $table = 'acara';
    protected $dates = [
        'masa_mula',
        'masa_tamat',
        'deleted_at',
    ];

    const JENIS_ACARA_RASMI = 'RASMI';
    const JENIS_ACARA_TIDAK_RASMI = 'TIDAK_RASMI';
    const STATUS_PERMOHONAN_MOHON = 'MOHON';
    const STATUS_PERMOHONAN_BATAL = 'BATAL';
    const STATUS_PERMOHONAN_LULUS = 'LULUS';
    const STATUS_PERMOHONAN_TOLAK = 'TOLAK';

    public function __construct()
    {
        $this->setDateFormat(config('pcrs.modelDateFormat'));
    }

    public function scopeEvents($query)
    {
        return $query->select(DB::raw('perkara as [title]'), DB::raw('masa_mula as [start]'), DB::raw('masa_tamat as [end]'), DB::raw('\'false\' as [allDay]'), DB::raw('\'#e74c3c\' as [color]'), DB::raw('\'white\' as [textColor]'), DB::raw('id'), DB::raw('jenis_acara'), DB::raw('keterangan'), DB::raw('\'' . Eventable::ACARA . '\' as [table_name]'));
    }

    public function scopeGetByDateRange($query, $start, $end)
    {
        $acaraMula = clone $query;

        return $query->where('masa_tamat', '>=', $start)->where('masa_tamat', '<', $end)->union($acaraMula->where('masa_mula', '>=', $start)->where('masa_mula', '<', $end));
    }

    public function scopeGetEventablesByDate($query, Carbon $tarikh)
    {
        $tarikh_tamat = clone $tarikh;

        return $query->events()->getByDateRange($tarikh, $tarikh_tamat->addDay());
    }

    public static function storeAcara(Anggota $profil, Request $request)
    {
        $acara = new Acara;
        $acara->jenis_acara = $request->input('jenisAcara');
        $acara->perkara = $request->input('perkara');
        $acara->masa_mula = $request->input('masaMula');
        $acara->masa_tamat = $request->input('masaTamat');
        $acara->keterangan = $request->input('keterangan');
        return $profil->acara()->save($acara);
    }

    public function eventableItem()
    {
        return collect([
            'title' => $this->perkara,
            'start' => $this->masa_mula->toDateTimeString(),
            'end' => $this->masa_tamat->toDateTimeString(),
            'allDay' => false,
            'color' => '#e74c3c',
            'textColor' => '#FFF',
            'id' => $this->id,
            'table_name' => 'acara'
        ]);
    }
}
