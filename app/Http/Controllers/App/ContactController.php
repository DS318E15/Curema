<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.contact.index', ['contacts' => Contact::where('active', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.contact.create', [
            'accounts' => Account::where('active', 1)->get(),
            'users' => User::where('active', 1)->get()
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
            'name' => 'required',
            'account_id' => 'required',
        ]);

        $contact = new Contact($request->all());
        $contact->user_id = Auth::user()->id;
        $contact->save();

        $contact->change('create');

        $request->session()->flash('alert-success', 'Contact was successfully created!');
        return redirect()->route('app.contact.show', $contact->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.contact.show', ['contact' => Contact::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.contact.edit', [
            'users' => User::all(),
            'accounts' => Account::where('active', 1)->get(),
            'contact' => Contact::find($id)
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
            'name' => 'required',
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $contact = Contact::find($id);
        $contact->fill($request->all());
        $contact->save();

        $contact->change('update');

        $request->session()->flash('alert-success', 'Contact was successfully updated!');
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
        $contact = Contact::find($id);
        $contact->active = 0;
        $contact->save();

        $contact->change('destroy');

        $request->session()->flash('alert-success', 'Contact was successfully destroyed!');
        return redirect()->route('app.contact.index');
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
        $contact = Contact::find($id);
        $contact->active = 1;
        $contact->save();

        $contact->change('restore');

        $request->session()->flash('alert-success', 'Contact was successfully restored!');
        return redirect()->back();
    }

    /**
     * Display a listing of the softdeleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('app.contact.trash', ['contacts' => Contact::where('active', 0)->get()]);
    }
}
