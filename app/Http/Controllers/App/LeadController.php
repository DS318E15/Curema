<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\App\Change;
use Curema\Models\App\Lead;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.lead.index', ['leads' => Lead::where('active', 1)->orderBy('updated_at', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.lead.create', [
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
            'user_id' => 'required',
        ]);

        $lead = new Lead($request->all());
        $lead->save();

        Change::create([
            "type" => "create",
            "lead_id" => $lead->id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Lead was successfully created!');
        return redirect()->route('app.lead.show', $lead->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead = Lead::find($id);

        return view('app.lead.show', [
            'lead' => $lead,
            'changes' => $lead->changes->take(5)
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
        return view('app.lead.edit', [
            'users' => User::all(),
            'lead' => Lead::find($id)
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
        ]);

        $lead = Lead::find($id);
        $lead->fill($request->all());
        $lead->save();

        Change::create([
            "type" => "update",
            "lead_id" => $lead->id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Lead was successfully updated!');
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
        $lead = Lead::find($id);
        $lead->active = 0;
        $lead->save();

        Change::create([
            "type" => "destroy",
            "lead_id" => $lead->id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Lead was successfully destroyed!');
        return redirect()->route('app.lead.index');
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
        $lead = Lead::find($id);
        $lead->active = 1;
        $lead->save();

        Change::create([
            "type" => "restore",
            "lead_id" => $lead->id,
            "user_id" => Auth::user()->id,
        ]);

        $request->session()->flash('alert-success', 'Lead was successfully restored!');
        return redirect()->back();
    }

    /**
     * Display a listing of the softdeleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('app.lead.trash', ['leads' => Lead::where('active', 0)->get()]);
    }

    /**
     * Display a listing of all activites on this ressource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function activities($id)
    {
        $lead = Lead::find($id);

        return view('app.lead.activities', [
            'lead' => $lead,
            'changes' => $lead->changes
        ]);
    }
}
