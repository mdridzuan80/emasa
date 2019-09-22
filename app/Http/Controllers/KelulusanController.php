<?php

namespace App\Http\Controllers;

use App\Base\BaseController;

class KelulusanController extends BaseController
{
    public function index()
    {
        return $this->renderView('kelulusan.index');
    }
}
