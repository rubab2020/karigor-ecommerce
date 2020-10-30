<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Karigor\Helpers\CustomHelper;

class BlogController extends Controller
{
    private $uploadPath;

    function __construct()
    {
        $this->uploadPath = Blog::getUploadPath();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::get();
        $uplaodPath = $this->uploadPath;

        return view('admin.blogs.index', compact('blogs', 'uplaodPath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bcategories = BlogCategory::pluck('name', 'id')->toArray();
        return view('admin.blogs.create', compact('bcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Blog $blog)
    {
        $imageBgName = CustomHelper::saveImage($request->file('cover_photo'), $this->uploadPath, 460, 460);
        $imageSmName = CustomHelper::saveImage($request->file('cover_photo'), $this->uploadPath, 230, 230);

        $blog->category_id = $request->input('category_id');
        $blog->slug = CustomHelper::generateSlug($request->input('title'), 'blogs');
        $blog->title = $request->input('title');
        $blog->cover_photo_bg = $imageBgName;
        $blog->cover_photo_sm = $imageSmName;
        $blog->description = $request->input('description');
        $blog->save();

        return redirect(route('blogs.index'))->with('success', 'Saved');
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
        $bcategories = BlogCategory::pluck('name', 'id')->toArray();
        $blog = Blog::findOrFail($id);
        $uplaodPath = $this->uploadPath;

        return view('admin.blogs.edit', compact('blog', 'bcategories', 'uplaodPath'));
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

        $blog = Blog::findOrFail($id);
        $blog->category_id = $request->input('category_id');
        $blog->slug = ($blog->title == $request->input('title'))
            ? $blog->slug
            : CustomHelper::generateSlug($blog->title, 'blogs');
        $blog->title = $request->input('title');
        if ($request->file('cover_photo')) {
            $imageBgName = CustomHelper::saveImage($request->file('cover_photo'), $this->uploadPath, 460, 460);
            $imageSmName = CustomHelper::saveImage($request->file('cover_photo'), $this->uploadPath, 230, 230);
            $blog->cover_photo_bg = $imageBgName;
            $blog->cover_photo_sm = $imageSmName;
        }
        $blog->description = $request->input('description');
        $blog->save();

        return redirect(route('blogs.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // delete file
        $fileName = public_path() . '/' . $blog->cover_photo_bg;
        if (file_exists($fileName))  \File::delete($fileName);
        $fileName = public_path() . '/' . $blog->cover_photo_sm;
        if (file_exists($fileName))  \File::delete($fileName);

        $blog->delete();

        return back()->with('success', 'Deleted');
    }
}
