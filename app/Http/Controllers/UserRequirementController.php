<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\UserRequirement;
use Illuminate\Support\Facades\DB;

use App\User;

class UserRequirementController extends Controller
{
    public function index()
    {
        $users = User::with('userRequirements.requirement')->whereHas('userRequirements')->get();
        $requirements = Requirement::all();

        return view('user_requirements.index', compact('users', 'requirements'));
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
        ]);
    
        $user_id = $request->input('user_id');
        $requirement_ids = $request->input('requirement_ids', []);
    
        foreach ($requirement_ids as $requirement_id) {
            UserRequirement::create([
                'user_id' => $user_id,
                'requirement_id' => $requirement_id,
            ]);
        }
    
        return redirect()->route('user_requirements.index')->with('success', 'Tələblər istifadəçiyə təyin edildi.');
    }
    
    public function edit($id)
    {
        // $userRequirement = UserRequirement::find(2);
        // dd($userRequirement);
        
        $userRequirement = UserRequirement::findOrFail($id); 
        $requirements = Requirement::all(); 
        return view('user_requirements.edit', compact('userRequirement', 'requirements'));
    }
    

public function update(Request $request, $id)
{
    $request->validate([
        'requirement_ids' => 'required|array',
        'requirement_ids.*' => 'exists:requirements,id',
    ]);

    $userRequirement = UserRequirement::findOrFail($id);
    $user_id = $userRequirement->user_id;

    UserRequirement::where('user_id', $user_id)->delete();

    $requirement_ids = $request->input('requirement_ids', []);
    foreach ($requirement_ids as $requirement_id) {
        UserRequirement::create([
            'user_id' => $user_id,
            'requirement_id' => $requirement_id,
        ]);
    }

    return redirect()->route('user_requirements.index')->with('success', 'Tələb redaktə edildi.');
}

    

// public function destroy($id)
// {
//     $userRequirement = UserRequirement::findOrFail($id);
//     $userId = $userRequirement->user_id;

//     UserRequirement::where('user_id', $userId)->delete();

//     $user = User::findOrFail($userId);
//     $user->delete();

//     return redirect()->route('user_requirements.index')->with('success', 'User and their requirements deleted successfully.');
// }


public function destroy($id)
{
        $userRequirement = UserRequirement::findOrFail($id);

       $userId = $userRequirement->user_id;

      UserRequirement::where('user_id', $userId)->delete();

    return redirect()->route('user_requirements.index')->with('success', 'Istifadəçi tələbləri silindi.');
}


}
