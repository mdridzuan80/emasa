<?php

namespace App\Transformers;

use App\Kehadiran;
use League\Fractal\TransformerAbstract;

class Event extends TransformerAbstract
{
    public function transform($event)
    {
        return [
            'title' => $event['title'],
            'start' => $event['start'],
            'end' => $event['end'],
            'allDay' => ($event['allDay'] === 'true') ? true : false,
            'color' => $this->colorTS($event),
            'textColor' => $event['textColor'],
            'scheme_id' => $event['id'],
            'scheme' => $event['table_name'],
            'kesalahan' => $event['kesalahan'] ?? json_encode([]),
            'tatatertib_flag' => $event['tatatertib_flag'] ?? Kehadiran::FLAG_TATATERTIB_CLEAR,
        ];
    }

    public function colorTS($event)
    {
        if (isset($event['tatatertib_flag']) && $event['tatatertib_flag'] == Kehadiran::FLAG_TATATERTIB_TUNJUK_SEBAB) {
            return 'Red';
        }

        return $event['color'];
    }
}
