<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use App\Models\HelpdeskCategory;
use Illuminate\Support\Facades\Auth;

class HelpDeskCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Auth::user()->department_id != 7) {
                return redirect(route('helpdesk.index'));
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = HelpdeskCategory::all();
        return view('pages.helpdesk_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.helpdesk_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = $request->all();
        HelpdeskCategory::create($category);
        return redirect(route('helpdesk_category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*  $gallery = GalleryCategory::find($id);
        return view('pages.helpdesk_category.show', compact('gallery')); */ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = HelpdeskCategory::find($id);
        return view('pages.helpdesk_category.edit', compact('category'));
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
        $category = HelpdeskCategory::find($id);
        $category->update($request->all());
        return redirect(route('helpdesk_category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = HelpdeskCategory::find($id);
        $category->delete();
        return redirect(route('helpdesk_category.index'));
    }
}
