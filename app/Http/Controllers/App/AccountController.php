<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\Change;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.account.index', ['accounts' => Account::where('active', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.account.create', [
            'users' => User::where('active', 1)->get(),
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
            'street_name' => 'required',
            'street_number' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
        ]);

        $account = new Account($request->all());
        $account->save();

        Change::create([
            "account_id" => $account->id,
            "user_id" => Auth::user()->id,
            "type" => "create"
        ]);

        $request->session()->flash('alert-success', 'Account was successfully created!');
        return redirect()->route('app.account.show', $account->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.account.show', ['account' => Account::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('app.account.edit', [
            'users' => User::all(),
            'account' => Account::find($id)
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
            'street_name' => 'required',
            'street_number' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'cvr' => 'numeric'
        ]);

        $account = Account::find($id);
        $account->fill($request->all());
        $account->save();

        Change::create([
            "account_id" => $account->id,
            "user_id" => Auth::user()->id,
            "type" => "update"
        ]);

        $request->session()->flash('alert-success', 'Account was successfully updated!');
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
        $account = Account::find($id);
        $account->active = 0;
        $account->save();

        Change::create([
            "account_id" => $account->id,
            "user_id" => Auth::user()->id,
            "type" => "destroy"
        ]);

        $request->session()->flash('alert-success', 'Account was successfully destroyed!');
        return redirect()->route('app.account.index');
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
        $account = Account::find($id);
        $account->active = 1;
        $account->save();

        Change::create([
            "account_id" => $account->id,
            "user_id" => Auth::user()->id,
            "type" => "restore"
        ]);

        $request->session()->flash('alert-success', 'Account was successfully restored!');
        return redirect()->back();
    }

    /**
     * Display a listing of the softdeleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('app.account.trash', ['accounts' => Account::where('active', 0)->get()]);
    }
}
