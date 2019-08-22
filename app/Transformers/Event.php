<?php

namespace App\Transformers;

use App\Utility;
use App\Kehadiran;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class Event extends TransformerAbstract
{
    private $event;

    private $startTag = '<div>';

    private $endTag = '</div>';

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

    public function colorTS()
    {
        if (isset($this->event['tatatertib_flag']) && $this->event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB) {
            return 'Red';
        }

        return $this->event['color'];
    }

    private function getTitle($event)
    {
        if ($this->event['table_name'] == 'final') {
            if ($this->event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB && !$this->event['cuti']) {
                $checkin = $this->subTitleCheckin(asset('images/icons/exclamation.png'));

                if (Utility::kesalahanCheckOut($this->event['kesalahan']) == Kehadiran::FLAG_KESALAHAN_AWAL) {
                    $checkout = '<div><img src="' . asset('images/icons/exclamation.png') . '"/>OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . '</div>';
                } else {
                    $checkout = $this->event['check_out'] ? '<div>OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . '</div>' : '<div><img src="' . asset('images/icons/exclamation.png') . '"/>OUT:-</div>';
                }
            } else {
                $checkin = $this->event['check_in'] ? '<div>IN:' . Carbon::parse($this->event['check_in'])->format('g:i:s A') . '</div>' : '<div>IN:-</div>';
                $checkout = $this->event['check_out'] ? '<div>OUT:' . Carbon::parse($this->event['check_out'])->format('g:i:s A') . '</div>' : '<div>OUT:-</div>';
            }

            return $checkin . $checkout;
        }

        return $event['title'];
    }

    private function subTitleCheckin($icon = '')
    {
        if ($this->event['check_in']) {
            return $this->startTag . 'IN:' . Carbon::parse($this->event['check_in'])->format('g:i:s A') . $this->endTag;
        }

        if ($icon) {
            return $this->startTag . '<img src="' . $icon . '"/>IN:-' . $this->endTag;
        }

        return $this->startTag . 'IN:-' . $this->endTag;
    }
}
