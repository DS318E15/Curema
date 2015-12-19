<?php

namespace Curema\Http\Controllers\App;

use Curema\Models\User;
use Illuminate\Http\Request;

use Curema\Http\Requests;
use Curema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.employee.index', ['employees' => User::where('active', 1)->orderBy('updated_at', 'DESC')->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('app.employee.show', [
            'employee' => $user,
            'changes' => $user->changes->take(5)
        ]);
    }

    /**
     * Display a listing of all activites on this ressource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function activities($id)
    {
        $user = User::find($id);

        return view('app.employee.activities', [
            'employee' => $user,
            'changes' => $user->changes
        ]);
    }
}
