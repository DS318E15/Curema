<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\User;
use Curema\Models\App\Email;
use Curema\Models\App\Lead;
use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index()
    {
        return view('app.email.index', [
            'emails' => Email::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.email.create', [
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

        $email = new Email;
        $email->fill($request->all());
        $email->save();

        $request->session()
            ->flash('alert-success', 'Email was successfully created!');

        return redirect()->route('app.email.show', $email->id);
    }

    public function show($id)
    {
        return view('app.email.show', [
            'email' => Email::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('app.email.edit', [
            'email' => Email::find($id),
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

        $email = Email::find($id);
        $email->fill($request->all());
        $email->save();

        $request->session()
            ->flash('alert-success', 'Email was successfully updated!');

        return redirect()->back();
    }

    public function activities($id)
    {
        return view('app.email.activities', [
            'email' => Email::find($id)
        ]);
    }
}
