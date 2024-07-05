<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            if (Auth::user()->id != 9) return redirect(route('helpdesk.index'));
            return $next($request);
        });
    }

    public function index()
    {
        $categories = HelpdeskCategory::all()->reverse();
        return view('pages.helpdesk_category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.helpdesk_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        HelpdeskCategory::create($request->all());
        return redirect(route('helpdesk-category.index'));
    }

    public function edit($id)
    {
        $category = HelpdeskCategory::find($id);
        if (!$category) return redirect()->back();
        return view('pages.helpdesk_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $category = HelpdeskCategory::find($id);
        if (!$category) return redirect()->back();

        $category->update($request->all());

        return redirect(route('helpdesk-category.index'));
    }
}
