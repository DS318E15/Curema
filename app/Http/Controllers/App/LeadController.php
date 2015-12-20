<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\User;
use Curema\Models\App\Lead;
use Curema\Models\App\Account;
use Curema\Models\App\Contact;
use Curema\Models\App\Opportunity;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;


class LeadController extends Controller
{
    public function index()
    {
        return view('app.lead.index', [
            'leads' => Lead::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.lead.create', [
            'users' => User::orderBy('name', 'ASC')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        $lead = new Lead;
        $lead->fill($request->all());
        $lead->save();

        $request->session()
            ->flash('alert-success', 'Lead was successfully created!');

        return redirect()->route('app.lead.show', $lead->id);
    }

    public function show($id)
    {
        return view('app.lead.show', [
            'lead' => Lead::withTrashed()->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('app.lead.edit', [
            'lead' => Lead::withTrashed()->find($id),
            'users' => User::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        $lead = Lead::find($id);
        $lead->fill($request->all());
        $lead->save();

        $request->session()
            ->flash('alert-success', 'Lead was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->delete();

        $request->session()
            ->flash('alert-success', 'Lead was successfully destroyed!');

        return redirect()->route('app.lead.index');
    }

    public function restore(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->restore();

        $request->session()
            ->flash('alert-success', 'Lead was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.lead.trash', [
            'leads' => Lead::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.lead.activities', [
            'lead' => Lead::find($id)
        ]);
    }

    public function conversion($id)
    {
        return view('app.lead.conversion', [
            'lead' => Lead::find($id),
            'users' => User::orderBy('name', 'ASC')->get()
        ]);
    }

    public function convert(Request $request, $id)
    {
        $this->validate($request, [
            'opportunity_name' => 'required',
            'account_name' => 'required',
            'contact_name' => 'required',
        ]);

        $lead = Lead::find($id);

        $account = Account::create([
            "name" => $request->account_name,
            "cvr" => $request->account_cvr,
            "phone" => $request->account_phone,
            "email" => $request->account_email,
            "website" => $request->account_website,
            "street_name" => $request->account_street_name,
            "street_number" => $request->account_street_number,
            "zip" => $request->account_zip,
            "city" => $request->account_city,
            "country" => $request->account_country,
            "user_id" => $lead->user_id,
        ]);

        Contact::create([
            "name" => $request->contact_name,
            "title" => $request->contact_title,
            "phone" => $request->contact_phone,
            "email" => $request->contact_email,
            "street_name" => $request->contact_street_name,
            "street_number" => $request->contact_street_number,
            "zip" => $request->contact_zip,
            "city" => $request->contact_city,
            "country" => $request->contact_country,
            "user_id" => $lead->user_id,
            "account_id" => $account->id,
        ]);

        $opportunity = Opportunity::create([
            "name" => $request->opportunity_name,
            "amount" => $request->opportunity_amount,
            "user_id" => $lead->user_id,
            "account_id" => $account->id,
        ]);

        $lead->delete();

        return redirect()->route('app.opportunity.show', $opportunity->id);
    }
}
