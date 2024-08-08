<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\User;
use Auth;


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
    $users = User::all();
    return view('requirements.create', compact('users'));
}

public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
        Requirement::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'), 
        ]);

        return redirect()->route('requirements.index')->with('success', 'Tələb yaradıldı ve rehber bilgisi eklendi!');
    }
       
    public function edit(Requirement $requirement)
{
    $allRequirements = Requirement::all();

    return view('requirements.edit', compact('requirement', 'allRequirements'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'string', 
        ]);
    
        $requirement = Requirement::findOrFail($id);
        $requirement->update($request->all());
    
        return redirect()->route('requirements.index')->with('success', 'Tələb redaktə edildi.');
    }

    public function destroy(Requirement $requirement)
    {
        $requirement->delete();

        return redirect()->route('requirements.index')->with('success', 'Tələb ugurla silindi.');
    }
    
     
}
