<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Models\Structure;
use App\Department;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->reverse();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->department_id == 10 || Auth::user()->email == 'nicat.b@nbatech.az' || Auth::user()->email == 'rauf.a@nbatech.az') {
            $structures = Structure::all()->reverse();
            $emails = User::where('status', 1)->pluck('email');
            $departaments = Department::all();
            $branchs = Branch::all();
            return view('pages.users.create', compact('structures', 'emails', 'departaments', 'branchs'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->department_id == 10 || Auth::user()->email == 'nicat.b@nbatech.az' || Auth::user()->email == 'rauf.a@nbatech.az') {
            $user = $request->all();
            if ($request->img) {
                $user['img']  = $request->file('img')->store('users', 'public');
            }
            User::create($user);
            return redirect(route('all_structure'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $emails = User::where('status', 1)->pluck('email');
        $departaments = Department::all();
        $branchs = Branch::all();
        return view('pages.users.edit', compact('user', 'departaments', 'branchs', 'emails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        if ($request->img) {
            $data['img']  = $request->file('img')->store('users', 'public');
        } else {
            $data['img']  = $user->img;
        }
        $user->fill($data)->save();
        return redirect('all_structure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
