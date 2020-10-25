<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Karigor\Helpers\CustomHelper;

class CategoryController extends Controller
{
    private $uploadPath = 'uploads/categories/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uplaodPath = $this->uploadPath;
        $categories = Category::get();
        return view('admin.categories.index', compact('categories', 'uplaodPath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::names();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $imageBgName = CustomHelper::saveImage($request->file('image'), $this->uploadPath, 600, 600);
        $imageSmName = CustomHelper::saveImage($request->file('image'), $this->uploadPath, 300, 300);
        $iconName = CustomHelper::saveImage($request->file('icon'), $this->uploadPath, 50, 50);

        $category->name = $request->input('name');
        $category->slug = \Str::slug($request->input('name'), '-');
        $category->parent_id = $request->input('parent_id');
        $category->image_bg = $imageBgName;
        $category->image_sm = $imageSmName;
        $category->icon = $iconName;
        $category->description = $request->input('description');
        $category->save();

        return redirect(route('categories.index'))->with('success', 'Saved');
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
        $uplaodPath = $this->uploadPath;
    	$category = Category::findOrFail($id);
        $categories = Category::names();

        return view('admin.categories.edit' , compact('category', 'categories', 'uplaodPath'));
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
    	$category = Category::findOrFail($id);

        $category->name = $request->input('name');
        $category->slug = str_slug($request->input('name'), '-');
        $category->parent_id = $request->input('parent_id');
        if($request->file('image')){
            $imageBgName = CustomHelper::saveImage($request->file('image'), 'uploads/categories/', 600, 600);
            $category->image_bg = $imageBgName;
            $imageSmName = CustomHelper::saveImage($request->file('image'), 'uploads/categories/', 300, 300);
            $category->image_sm = $imageSmName;
        }
        if($request->file('icon')){
            $iconName = Category::saveImage($request->file('icon'), 'uploads/categories/', 50, 50);
            $category->icon = $iconName;
        }
        $category->description = $request->input('description');

        $category->save();

        return redirect(route('categories.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // delete file
        $fileName = public_path().'/'.$category->image_bg;
        if(file_exists($fileName)) \File::delete($fileName);
        $fileName = public_path().'/'.$category->image_sm;
        if(file_exists($fileName)) \File::delete($fileName);
        $fileName = public_path().'/'.$category->icon;
        if(file_exists($fileName)) \File::delete($fileName);

        $category->delete();

        return back()->with('success', 'Deleted');
    }
}
