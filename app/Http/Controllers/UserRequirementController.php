<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\UserRequirement;
use App\User;
use App\Department;

use Auth;

class UserRequirementController extends Controller
{
    public function accept($id)
    {
    $userRequirement = UserRequirement::findOrFail($id);

    $userRequirement->update(['status' => 'Accept']);

    return redirect()->route('user_requirements.index')->with('success', 'Tələb qəbul edildi.');
    }
    public function reject($id)
    {
    $userRequirement = UserRequirement::findOrFail($id);

    $userRequirement->update(['status' => 'Reject']);

    return redirect()->route('user_requirements.index')->with('warning', 'Tələb rədd edildi.');
    }
    public function index()
    {
        if(Auth::user()->department_id == 10){
            $requirements = UserRequirement::all();
        }else {
            $requirements = UserRequirement::whereHas('requirement', function($q){
                $q->where('user_id',Auth::user()->id);
            })->get();
        }

        return view('user_requirements.index', compact('requirements'));
    }


    public function create()
    {
        $users = User::all();
        $requirements = Requirement::all();
        return view('user_requirements.create', compact('users', 'requirements'));
    }

    


    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'requirement_ids' => 'required|array',
        'requirement_ids.*' => 'exists:requirements,id',
        'type' => 'required|string|in:entry,exit',
    ]);

    $user_id = $request->input('user_id');
    $requirement_ids = $request->input('requirement_ids', []);
    $guide_user_id = $request->input('guide_user_id');
    $type = $request->input('type');

    foreach ($requirement_ids as $requirement_id) {
        UserRequirement::create([
            'user_id' => $user_id,
            'requirement_id' => $requirement_id,
            'type' => $type,
            // 'status' => 'pending',
            // 'guide_user_id' => $guide_user_id,
        ]);
    }

    return redirect()->route('user_requirements.index')->with('success', 'Tələblər istifadəçiyə təyin edildi.');
}


    public function edit(Requirement $requirement, $id)
    {
        $userRequirement = UserRequirement::with('requirement', 'guideUser')->findOrFail($id);
        $allRequirements = Requirement::all();
        $users = User::all(); 
        return view('user_requirements.edit', compact('userRequirement', 'users', 'allRequirements'));
    }
    

public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'requirement_ids' => 'required|array',
        'requirement_ids.*' => 'exists:requirements,id',
        'status' => 'required|string',
        'guide_user_id' => 'nullable|exists:users,id',
        'type' => 'required|string|in:entry,exit',
    ]);

    $userRequirement = UserRequirement::findOrFail($id);

    $userRequirement->update([
        'user_id' => $request->input('user_id'),
        'status' => $request->input('status'),
        'guide_user_id' => $request->input('guide_user_id'),
        'type' => $request->input('type'),
    ]);

    $userRequirement->requirements()->sync($request->input('requirement_ids'));

    return redirect()->route('user_requirements.index')->with('success', 'Tələb redaktə edildi.');
}


    public function destroy($id)
    {
        $userRequirement = UserRequirement::all();

        UserRequirement->delete();

        return redirect()->route('user_requirements.index')->with('success', 'Istifadəçi tələbləri silindi.');
    }
}
