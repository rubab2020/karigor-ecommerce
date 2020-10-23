<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\karigor\Helpers\CustomHelper;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bcategories = BlogCategory::get();
        return view('admin.blog-categories.index', compact('bcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BlogCategory $bcategory)
    {
        $bcategory->name = $request->input('name');
        $bcategory->slug = CustomHelper::generateSlug($bcategory->name, 'blog_categories');
        $bcategory->save();

        return redirect(route('blog-categories.index'))->with('success', 'Saved');
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
    	$bcategory = BlogCategory::findOrFail($id);
        return view('admin.blog-categories.edit' , compact('bcategory'));
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
    	$bcategory = BlogCategory::findOrFail($id);
        $bcategory->name = $request->input('name');
        $bcategory->slug = ($bcategory->name == $bcategory->name) 
                            ? $bcategory->slug
                            : CustomHelper::generateSlug($bcategory->name, 'blog_categories');
        $bcategory->save();

        return redirect(route('blog-categories.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bcategory = BlogCategory::findOrFail($id);
        $bcategory->delete();

        return back()->with('success', 'Deleted');
    }
}
