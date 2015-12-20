<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\User;
use Curema\Models\App\Account;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {
        return view('app.account.index', [
            'accounts' => Account::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.account.create', [
            'users' => User::orderBy('name', 'ASC')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        $account = new Account;
        $account->fill($request->all());
        $account->save();

        Change::create([
            'type' => 'create',
            'subject' => 'account',
            'user_id' => auth()->user()->id,
            'account_id' => $account->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Account was successfully created!');

        return redirect()->route('app.account.show', $account->id);
    }

    public function show($id)
    {
        return view('app.account.show', [
            'account' => Account::withTrashed()->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('app.account.edit', [
            'account' => Account::withTrashed()->find($id),
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        $account = Account::find($id);
        $account->fill($request->all());
        $account->save();

        Change::create([
            'type' => 'update',
            'subject' => 'account',
            'user_id' => auth()->user()->id,
            'account_id' => $account->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Account was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $account = Account::find($id);
        $account->delete();

        Change::create([
            'type' => 'delete',
            'subject' => 'account',
            'user_id' => auth()->user()->id,
            'account_id' => $account->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Account was successfully destroyed!');

        return redirect()->route('app.account.index');
    }

    public function restore(Request $request, $id)
    {
        $account = Account::withTrashed()->find($id);
        $account->restore();

        Change::create([
            'type' => 'restore',
            'subject' => 'account',
            'user_id' => auth()->user()->id,
            'account_id' => $account->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Account was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.account.trash', [
            'accounts' => Account::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.account.activities', [
            'account' => Account::find($id)
        ]);
    }
}
