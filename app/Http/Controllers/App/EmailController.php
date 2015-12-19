<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\email;
use Curema\Models\App\Change;
use Curema\Models\App\Contact;
use Curema\Models\App\Lead;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.email.index', ['emails' => Email::orderBy('updated_at', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.email.create', [
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

        $email = new Email($request->all());
        $email->save();

        Change::create([
            "type" => "create",
            "email_id" => $email->id,
            "lead_id" => $email->lead_id,
            "contact_id" => $email->contact_id,
            "account_id" => $email->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Email was successfully created!');
        return redirect()->route('app.email.show', $email->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email = Email::find($id);

        return view('app.email.show', [
            'email' => $email,
            'changes' => $email->changes->take(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.email.edit', [
            'email' => Email::find($id),
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

        $email = Email::find($id);
        $email->fill($request->all());
        $email->save();

        Change::create([
            "type" => "update",
            "email_id" => $email->id,
            "lead_id" => $email->lead_id,
            "contact_id" => $email->contact_id,
            "account_id" => $email->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Email was successfully updated!');
        return redirect()->back();
    }

    /**
     * Display a listing of all activites on this ressource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function activities($id)
    {
        $email = Email::find($id);

        return view('app.email.activities', [
            'email' => $email,
            'changes' => $email->changes
        ]);
    }
}
