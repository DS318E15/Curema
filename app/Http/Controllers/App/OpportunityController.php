<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\User;
use Curema\Models\App\Account;
use Curema\Models\App\Opportunity;
use Curema\Models\App\OpportunityStage;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('app.opportunity.index', [
            'opportunities' => Opportunity::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.opportunity.create', [
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

        $opportunity = new Opportunity;
        $opportunity->fill($request->all());
        $opportunity->save();

        Change::create([
            'type' => 'create',
            'subject' => 'opportunity',
            'user_id' => auth()->user()->id,
            'account_id' => $opportunity->account_id,
            'opportunity_id' => $opportunity->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Opportunity was successfully created!');

        return redirect()->route('app.opportunity.show', $opportunity->id);
    }

    public function show($id)
    {
        return view('app.opportunity.show', [
            'opportunity' => Opportunity::withTrashed()->find($id),
            'stages' => OpportunityStage::all(),
        ]);
    }

    public function edit($id)
    {
        return view('app.opportunity.edit', [
            'opportunity' => Opportunity::withTrashed()->find($id),
            'users' => User::orderBy('name', 'ASC')->get(),
            'accounts' => Account::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            'account_id' => 'required'
        ]);

        $opportunity = Opportunity::withTrashed()->find($id);
        $opportunity->fill($request->all());
        $opportunity->save();

        Change::create([
            'type' => 'update',
            'subject' => 'opportunity',
            'user_id' => auth()->user()->id,
            'account_id' => $opportunity->account_id,
            'opportunity_id' => $opportunity->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Opportunity was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $opportunity = Opportunity::find($id);
        $opportunity->delete();

        Change::create([
            'type' => 'delete',
            'subject' => 'opportunity',
            'user_id' => auth()->user()->id,
            'account_id' => $opportunity->account_id,
            'opportunity_id' => $opportunity->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Opportunity was successfully destroyed!');

        return redirect()->route('app.opportunity.index');
    }

    public function restore(Request $request, $id)
    {
        $opportunity = Account::withTrashed()->find($id);
        $opportunity->restore();

        Change::create([
            'type' => 'restore',
            'subject' => 'opportunity',
            'user_id' => auth()->user()->id,
            'account_id' => $opportunity->account_id,
            'opportunity_id' => $opportunity->id,
        ]);

        $request->session()
            ->flash('alert-success', 'Opportunity was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.opportunity.trash', [
            'opportunities' => Opportunity::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.opportunity.activities', [
            'opportunity' => Opportunity::withTrashed()->find($id)
        ]);
    }

    public function stage(Request $request, $id)
    {
        $this->validate($request, [
            'opportunity_stage_id' => 'required',
        ]);

        $opportunity = Opportunity::withTrashed()->find($id);
        $opportunity->opportunity_stage_id = $request->opportunity_stage_id;
        $opportunity->save();

        Change::create([
            'type' => 'stage',
            'subject' => 'opportunity',
            'user_id' => auth()->user()->id,
            'account_id' => $opportunity->account_id,
            'opportunity_id' => $opportunity->id,
        ]);

        return redirect()->back();
    }
}
