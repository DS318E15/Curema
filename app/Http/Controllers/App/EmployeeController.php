<?php

namespace Curema\Http\Controllers\App;

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
        //
    }

    public function store(Request $request)
    {
        //
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
        ]);
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
