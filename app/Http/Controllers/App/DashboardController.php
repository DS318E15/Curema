<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Opportunity;
use Curema\Models\App\Ticket;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        return view('app.dashboard.index', [
            'opportunities' => Opportunity::where('user_id', auth()->user()->id)
                ->where('opportunity_stage_id', '<=', 3)
                ->orderBy('updated_at', 'DESC')
                ->get(),

            'tickets' => Ticket::where('user_id', auth()->user()->id)
                ->orderBy('updated_at', 'DESC')
                ->get()
        ]);
    }
}
