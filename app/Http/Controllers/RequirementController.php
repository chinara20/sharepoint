<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\Userr;


class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = Requirement::all();
        return view('requirements.index', compact('requirements'));
    }

    public function create()
    {
        return view('requirements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Requirement::create($request->all());

        return redirect()->route('requirements.index')->with('success', 'Tələb ugurla yaradıldı.');
    }

    public function edit(Requirement $requirement)
    {
        return view('requirements.edit', compact('requirement'));
    }

    public function update(Request $request, Requirement $requirement)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $requirement->update($request->all());

        return redirect()->route('requirements.index')->with('success', 'Tələb redaktə edildi.');
    }

    public function destroy(Requirement $requirement)
    {
        $requirement->delete();

        return redirect()->route('requirements.index')->with('success', 'Tələb ugurla silindi.');
    }
}
