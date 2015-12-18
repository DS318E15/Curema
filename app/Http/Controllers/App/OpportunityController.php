<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Account;
use Curema\Models\App\Change;
use Curema\Models\App\Opportunity;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.opportunity.index', ['opportunities' => Opportunity::where('active', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.opportunity.create', [
            'users' => User::where('active', 1)->get(),
            'accounts' => Account::where('active', 1)->get(),
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
            'user_id' => 'required',
            'account_id' => 'required',
        ]);

        $opportunity = new Opportunity($request->all());
        $opportunity->save();

        Change::create([
            "type" => "create",
            "opportunity_id" => $opportunity->id,
            "account_id" => $opportunity->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Opportunity was successfully created!');
        return redirect()->route('app.opportunity.show', $opportunity->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.opportunity.show', [
            'opportunity' => Opportunity::find($id),
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
        return view('app.opportunity.edit', [
            'users' => User::all(),
            'accounts' => Account::all(),
            'opportunity' => Opportunity::find($id),
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
            'account_id' => 'required'
        ]);

        $opportunity = Opportunity::find($id);
        $opportunity->fill($request->all());
        $opportunity->save();

        Change::create([
            "type" => "update",
            "opportunity_id" => $opportunity->id,
            "account_id" => $opportunity->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Opportunity was successfully updated!');
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
        $opportunity = Opportunity::find($id);
        $opportunity->active = 0;
        $opportunity->save();

        Change::create([
            "type" => "destroy",
            "opportunity_id" => $opportunity->id,
            "account_id" => $opportunity->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Opportunity was successfully destroyed!');
        return redirect()->route('app.opportunity.index');
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
        $opportunity = Opportunity::find($id);
        $opportunity->active = 1;
        $opportunity->save();

        Change::create([
            "type" => "restore",
            "opportunity_id" => $opportunity->id,
            "account_id" => $opportunity->account_id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Opportunity was successfully restored!');
        return redirect()->back();
    }

    /**
     * Display a listing of the softdeleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('app.opportunity.trash', ['opportunities' => Opportunity::where('active', 0)->get()]);
    }
}
