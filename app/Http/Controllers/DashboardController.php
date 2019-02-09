<?php

namespace App\Http\Controllers;

use App\Role;
use App\Base\BaseController;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        return $this->renderView('dashboard.index');
    }
}
