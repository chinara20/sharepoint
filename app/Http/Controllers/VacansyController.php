<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacansy;


class VacansyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $vacansies = Vacansy::all()->reverse();
        return view('pages.vacansy.index',compact('vacansies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.vacansy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $vacansy = $request->all();
        Vacansy::create($vacansy);
        return redirect(route('vacansy.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacansy = Vacansy::find($id);
        return view('pages.vacansy.show',compact('vacansy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacansy = Vacansy::find($id);
        return view('pages.vacansy.edit',compact('vacansy'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacansy = Vacansy::find($id);
        $vacansy->delete();
        return back();
    }
}
