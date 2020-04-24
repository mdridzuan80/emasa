<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class PuasaTransformer extends TransformerAbstract
{
    public function transform($item)
    {
        return [
            'tkhmula' => $item->tkhMula,
            'tkhtamat' => $item->tkhTamat,
        ];
    }
}
