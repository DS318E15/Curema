<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\Call;
use Curema\Models\App\Change;
use Curema\Models\App\Contact;
use Curema\Models\App\Lead;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.call.index', ['calls' => Call::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.call.create', [
            'leads' => Lead::all(),
            'accounts' => Account::all(),
            'contacts' => Contact::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'user_id' => 'required',
        ]);

        $call = new Call($request->all());
        $call->save();

        Change::create([
            "call_id" => $call->id,
            "user_id" => Auth::user()->id,
            "type" => "create"
        ]);

        $request->session()->flash('alert-success', 'Call was successfully created!');
        return redirect()->route('app.call.show', $call->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.call.show', ['call' => Call::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.call.edit', [
            'call' => Call::find($id),
            'leads' => Lead::all(),
            'accounts' => Account::all(),
            'contacts' => Contact::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'content' => 'required',
        ]);

        $call = Call::find($id);
        $call->fill($request->all());
        $call->save();

        Change::create([
            "call_id" => $call->id,
            "user_id" => Auth::user()->id,
            "type" => "update"
        ]);

        $request->session()->flash('alert-success', 'Call was successfully updated!');
        return redirect()->back();
    }
}
