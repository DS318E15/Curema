<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Curema\Models\App\Ticket;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.ticket.index', ['tickets' => Ticket::where('active', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.ticket.create', [
            'users' => User::where('active', 1)->get(),
            'accounts' => Account::where('active', 1)->get(),
            'contacts' => Contact::where('active', 1)->get(),
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
            'subject' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        $ticket = new Ticket($request->all());
        $ticket->save();

        $ticket->change('create');

        $request->session()->flash('alert-success', 'Ticket was successfully created!');
        return redirect()->route('app.ticket.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.ticket.show', ['ticket' => Ticket::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.ticket.edit', [
            'users' => User::all(),
            'accounts' => Account::all(),
            'contacts' => Contact::all(),
            'ticket' => Ticket::find($id)
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
            'subject' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        $ticket = Ticket::find($id);
        $ticket->fill($request->all());
        $ticket->save();

        $ticket->change('update');

        $request->session()->flash('alert-success', 'Ticket was successfully updated!');
        return redirect()->back();
    }

    /**
     * Deactivate the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->active = 0;
        $ticket->save();

        $ticket->change('destroy');

        $request->session()->flash('alert-success', 'Ticket was successfully destroyed!');
        return redirect()->route('app.ticket.index');
    }

    /**
     * Activate the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->active = 1;
        $ticket->save();

        $ticket->change('restore');

        $request->session()->flash('alert-success', 'Ticket was successfully restored!');
        return redirect()->back();
    }

    /**
     * Display a listing of the softdeleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('app.ticket.trash', ['tickets' => Ticket::where('active', 0)->get()]);
    }
}
