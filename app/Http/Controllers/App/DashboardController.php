<?php

namespace Curema\Http\Controllers\App;

use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getIndex() {
        return view('app.dashboard.index');
    }
}
