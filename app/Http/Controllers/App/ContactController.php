<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\User;
use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function index()
    {
        return view('app.contact.index', [
            'contacts' => Contact::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.contact.create', [
            'users' => User::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $contact = new Contact;
        $contact->fill($request->all());
        $contact->save();

        Change::create([
            'type' => 'create',
            'subject' => 'contact',
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->id,
            'account_id' => $contact->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Contact was successfully created!');

        return redirect()->route('app.contact.show', $contact->id);
    }

    public function show($id)
    {
        return view('app.contact.show', [
            'contact' => Contact::withTrashed()->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('app.contact.edit', [
            'contact' => Contact::withTrashed()->find($id),
            'users' => User::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $contact = Contact::find($id);
        $contact->fill($request->all());
        $contact->save();

        Change::create([
            'type' => 'update',
            'subject' => 'contact',
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->id,
            'account_id' => $contact->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Contact was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        Change::create([
            'type' => 'delete',
            'subject' => 'contact',
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->id,
            'account_id' => $contact->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Contact was successfully destroyed!');

        return redirect()->route('app.contact.index');
    }

    public function restore(Request $request, $id)
    {
        $contact = Contact::withTrashed()->find($id);
        $contact->restore();

        Change::create([
            'type' => 'restore',
            'subject' => 'contact',
            'user_id' => auth()->user()->id,
            'contact_id' => $contact->id,
            'account_id' => $contact->account_id,
        ]);

        $request->session()
            ->flash('alert-success', 'Contact was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.contact.trash', [
            'contacts' => Contact::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.contact.activities', [
            'contact' => Contact::find($id)
        ]);
    }
}
