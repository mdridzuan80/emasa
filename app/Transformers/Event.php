<?php

namespace App\Transformers;

use App\Utility;
use Carbon\Carbon;
use App\Kehadiran;
use League\Fractal\TransformerAbstract;

class Event extends TransformerAbstract
{
    public function transform($event)
    {
        return [
            'title' => $this->getTitle($event),
            'start' => $event['start'],
            'end' => $event['end'],
            'allDay' => ($event['allDay'] === 'true') ? true : false,
            'color' => $this->colorTS($event),
            'textColor' => $event['textColor'],
            'scheme_id' => $event['id'],
            'scheme' => $event['table_name'],
            'kesalahan' => $event['kesalahan'] ?? json_encode([]),
            'tatatertib_flag' => $event['tatatertib_flag'] ?? Kehadiran::FLAG_TATATERTIB_CLEAR,
            'textEscape' => false,
        ];
    }

    public function colorTS($event)
    {
        if (isset($event['tatatertib_flag']) && $event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB) {
            return 'Red';
        }

        return $event['color'];
    }

    private function getTitle($event)
    {
        if ($event['table_name'] == 'final') {
            if ($event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB && !$event['cuti']) {
                $checkin = $event['check_in'] ? '<div>IN:' . Carbon::parse($event['check_in'])->format('g:i:s A') . '</div>' : '<div><img src="' . asset('images/icons/exclamation.png') . '"/>IN:-</div>';

                if (Utility::kesalahanCheckOut($event['kesalahan']) == Kehadiran::FLAG_KESALAHAN_AWAL) {
                    $checkout = '<div><img src="' . asset('images/icons/exclamation.png') . '"/>OUT:' . Carbon::parse($event['check_out'])->format('g:i:s A') . '</div>';
                } else {
                    $checkout = $event['check_out'] ? '<div>OUT:' . Carbon::parse($event['check_out'])->format('g:i:s A') . '</div>' : '<div><img src="' . asset('images/icons/exclamation.png') . '"/>OUT:-</div>';
                }
            } else {
                $checkin = $event['check_in'] ? '<div>IN:' . Carbon::parse($event['check_in'])->format('g:i:s A') . '</div>' : '<div>IN:-</div>';
                $checkout = $event['check_out'] ? '<div>OUT:' . Carbon::parse($event['check_out'])->format('g:i:s A') . '</div>' : '<div>OUT:-</div>';
            }

            return $checkin . $checkout;
        }

        return $event['title'];
    }
}
