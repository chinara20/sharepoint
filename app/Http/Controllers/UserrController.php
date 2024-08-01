<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\UserRequirement;
use App\Models\Userr; 
use Illuminate\Support\Facades\Hash;

class UserrController extends Controller
{
    public function index()
    {
        $requirements = Requirement::all();
        $users = Userr::all();
        return view('userrs.index', compact('users', 'requirements'));
    }

    public function create()
    {
        $requirements = Requirement::all();
        return view('userrs.create', compact('requirements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = Userr::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $requirement_ids = $request->input('requirement_ids', []);
        foreach ($requirement_ids as $requirement_id) {
            UserRequirement::create([
                'user_id' => $user->id,
                'requirement_id' => $requirement_id,
                'completed' => false
            ]);
        }

        return redirect()->route('userrs.index')->with('success', 'İstifadəçi uğurla yaradıldı.');
    }

    public function edit($id)
    {
        $userRequirement = UserRequirement::findOrFail($id);
        return view('user_requirements.edit', compact('userRequirement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'requirement_id' => 'required|exists:requirements,id',
        ]);

        $userRequirement = UserRequirement::findOrFail($id);
        $userRequirement->update($request->all());

        return redirect()->route('user_requirements.index')->with('success', 'Tələb uğurla yeniləndi!');
    }
}
