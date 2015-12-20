<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\User;
use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Curema\Models\App\Ticket;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('app.ticket.index', [
            'tickets' => Ticket::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.ticket.create', [
            'users' => User::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
            'contacts' => Contact::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->fill($request->all());
        $ticket->save();

        Change::create([
            'type' => 'create',
            'subject' => 'ticket',
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Ticket was successfully created!');

        return redirect()->route('app.ticket.show', $ticket->id);
    }

    public function show($id)
    {
        return view('app.ticket.show', [
            'ticket' => Ticket::withTrashed()->find($id),
        ]);
    }

    public function edit($id)
    {
        return view('app.ticket.edit', [
            'ticket' => Ticket::withTrashed()->find($id),
            'users' => User::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
            'contacts' => Contact::orderBy('name', 'ASC')->get(),
        ]);
    }

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

        Change::create([
            'type' => 'update',
            'subject' => 'ticket',
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Ticket was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        Change::create([
            'type' => 'delete',
            'subject' => 'ticket',
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Ticket was successfully destroyed!');

        return redirect()->route('app.ticket.index');
    }

    public function restore(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->restore();

        Change::create([
            'type' => 'restore',
            'subject' => 'ticket',
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Ticket was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.ticket.trash', [
            'tickets' => Ticket::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.ticket.activities', [
            'ticket' => Ticket::find($id)
        ]);
    }
}
