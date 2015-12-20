<?php

namespace Curema\Http\Controllers\App;

use Bican\Roles\Models\Role;
use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('app.employee.index', [
            'employees' => User::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('app.employee.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        $user->detachAllRoles();
        $user->attachRole(Role::find($request->role_id));

        $request->session()
            ->flash('alert-success', 'Employee was successfully created!');

        return redirect()->route('app.employee.show', $user->id);
    }

    public function show($id)
    {
        return view('app.employee.show', [
            'employee' => User::withTrashed()->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('app.employee.edit', [
            'employee' => User::withTrashed()->find($id),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
        ]);

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        $user->detachAllRoles();
        $user->attachRole(Role::find($request->role_id));

        $request->session()
            ->flash('alert-success', 'Employee was successfully updated!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->delete();

        $request->session()
            ->flash('alert-success', 'Employee was successfully destroyed!');

        return redirect()->route('app.employee.index');
    }

    public function restore(Request $request, $id)
    {
        $employee = User::withTrashed()->find($id);
        $employee->restore();

        $request->session()
            ->flash('alert-success', 'Employee was successfully restored!');

        return redirect()->back();
    }

    public function trash()
    {
        return view('app.employee.trash', [
            'employee' => User::onlyTrashed()
                ->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function activities($id)
    {
        return view('app.employee.activities', [
            'employee' => User::find($id)
        ]);
    }
}
