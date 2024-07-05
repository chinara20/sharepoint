<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories =  ProductCategory::all()->reverse();
        return view('pages.product_category.index',compact('product_categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_category()
    {
        $product_categories =  ProductCategory::all()->reverse();
        return view('pages.product_category.all',compact('product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_category = $request->all();
        $image = $request->file('img')->store('product_categories','public');
        $product_category['img'] = $image;
        ProductCategory::create($product_category);
        return redirect(route('product_category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products =  Product::where('category_id',$id)->get();
        return view('pages.product_category.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_category = ProductCategory::find($id);
        return view('pages.product_category.edit',compact('product_category'));

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
        $product_category = ProductCategory::find($id);
        $data = $request->all();
        if ($request->img) {
        $image = $request->file('img')->store('product_categories','public');
        $data['img'] = $image;
        }else{
        $data['img'] = $product_category->img;
        }
        $product_category->update($data);
        return redirect(route('product_category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_category = ProductCategory::find($id);
        $product_category->delete();
        return redirect(route('product_category.index'));
    }
}
