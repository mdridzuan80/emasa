<?php

namespace App\Transformers;

use App\Utility;
use App\Kehadiran;
use Carbon\Carbon;
use App\Justifikasi;
use League\Fractal\TransformerAbstract;

class Event extends TransformerAbstract
{
    private $event;

    private $startTag = '<div>';

    private $endTag = '</div>';

    const FLAG_KELULUSAN_ICON = [
        'DEFAULT' => 'images/icons/exclamation.png',
        'MOHON' => 'images/icons/bandaid.png',
        'LULUS' => 'images/icons/tick.png',
        'BATAL' => 'images/icons/tick.png',
    ];

    public function transform($event)
    {
        $this->event = $event;

        return [
            'title' => $this->getTitle(),
            'start' => $event['start'],
            'end' => $event['end'],
            'allDay' => ($event['allDay'] === 'true') ? true : false,
            'color' => $this->colorTS(),
            'textColor' => $event['textColor'],
            'scheme_id' => $event['id'],
            'scheme' => $event['table_name'],
            'kesalahan' => $event['kesalahan'] ?? json_encode([]),
            'tatatertib_flag' => $event['tatatertib_flag'] ?? Kehadiran::FLAG_TATATERTIB_CLEAR,
        ];
    }

    private function colorTS()
    {
        if (isset($this->event['tatatertib_flag']) && $this->event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB) {
            return 'Red';
        }

        return $this->event['color'];
    }

    private function getTitle()
    {
        if ($this->event['table_name'] == 'final') {
            $checkin = $this->subTitleCheckin($this->chkJustifikasiStatusIcon($this->event['justifikasi'], Justifikasi::FLAG_MEDAN_KESALAHAN_PAGI));

            //if (Utility::kesalahanCheckOut($this->event['kesalahan']) == Kehadiran::FLAG_KESALAHAN_AWAL) {
            $checkout = $this->subTitleCheckout($this->chkJustifikasiStatusIcon($this->event['justifikasi'], Justifikasi::FLAG_MEDAN_KESALAHAN_PETANG));
            //} else {
            //$checkout = $this->event['check_out'] ? '<div>OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . '</div>' : '<div><img src="' . asset('images/icons/exclamation.png') . '"/>OUT:-</div>';
            //}

            return $checkin . $checkout;
        }

        return $this->event['title'];
    }

    private function subTitleCheckin($icon = '')
    {
        if ($this->event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB && !$this->event['cuti']) {
            if ($this->event['check_in']) {
                return $this->startTag . 'IN:' . Carbon::parse($this->event['check_in'])->format('g:i:s A') . $this->endTag;
            }

            if ($icon) {
                return $this->startTag . '<img src="' . $icon . '"/>IN:-' . $this->endTag;
            }
        } else {
            if ($this->event['check_in']) {
                return $this->startTag . 'IN:' . Carbon::parse($this->event['check_in'])->format('g:i:s A') . $this->endTag;
            }
        }

        return $this->startTag . 'IN:-' . $this->endTag;
    }

    private function subTitleCheckout($icon = '')
    {
        if ($this->event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB && !$this->event['cuti']) {

            if ($this->event['check_out']) {

                if (!Utility::kesalahanCheckOut($this->event['kesalahan']) == Kehadiran::FLAG_KESALAHAN_AWAL) {
                    return $this->startTag . 'OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . $this->endTag;
                }
            }

            if ($icon) {
                return $this->startTag . '<img src="' . $icon . '"/>OUT:-' . $this->endTag;
            }
        } else {

            if ($this->event['check_out']) {
                return $this->startTag . 'OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . $this->endTag;
            }
        }

        return $this->startTag . 'OUT:-' . $this->endTag;
    }

    private function chkJustifikasiStatusIcon($justifikasi, $medan)
    {
        $justifikasi = collect($justifikasi);

        if ($justifikasi->isNotEmpty()) {
            $justifikasi = $justifikasi->where('medan_kesalahan', $medan)->first();

            if ($justifikasi) {
                return asset(Self::FLAG_KELULUSAN_ICON[$justifikasi['flag_kelulusan']]);
            }
        }

        return asset(Self::FLAG_KELULUSAN_ICON['DEFAULT']);
    }
}
