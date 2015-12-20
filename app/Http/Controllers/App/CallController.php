<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\User;
use Curema\Models\App\Call;
use Curema\Models\App\Lead;
use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class CallController extends Controller
{
    public function index()
    {
        return view('app.call.index', [
            'calls' => Call::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.call.create', [
            'leads' => Lead::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
            'contacts' => Contact::orderBy('name', 'ASC')->get(),
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'user_id' => 'required',
        ]);

        $call = new Call;
        $call->fill($request->all());
        $call->save();

        Change::create([
            'type' => 'create',
            'subject' => 'call',
            'user_id' => auth()->user()->id,
            'call_id' => $call->id,
            'lead_id' => $call->lead_id,
            'contact_id' => $call->contact_id,
            'account_id' => $call->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Call was successfully created!');

        return redirect()->route('app.call.show', $call->id);
    }

    public function show($id)
    {
        return view('app.call.show', [
            'call' => Call::find($id)
        ]);
    }

    public function edit($id)
    {
        return view('app.call.edit', [
            'call' => Call::find($id),
            'leads' => Lead::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
            'contacts' => Contact::orderBy('name', 'ASC')->get(),
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
            'user_id' => 'required',
        ]);

        $call = Call::find($id);
        $call->fill($request->all());
        $call->save();

        Change::create([
            'type' => 'update',
            'subject' => 'call',
            'user_id' => auth()->user()->id,
            'call_id' => $call->id,
            'lead_id' => $call->lead_id,
            'contact_id' => $call->contact_id,
            'account_id' => $call->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Call was successfully updated!');

        return redirect()->back();
    }

    public function activities($id)
    {
        return view('app.call.activities', [
            'call' => Call::find($id)
        ]);
    }
}
