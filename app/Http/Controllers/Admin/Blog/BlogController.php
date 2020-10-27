<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\DigiMarketersHub\CustomHelper;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blogs.index', compact('blogs'));
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
        // saving image in the directory
        $coverPhoto = $request->file('cover_photo');
        $imageLink = '';
        if ($coverPhoto) {
            $path = 'images/uploads/blogs/';
            $fileName = time() . '-' . $coverPhoto->getClientOriginalName();
            $imageLink = $path . $fileName;
            // $img = \Image::make(base64_decode($coverPhoto))
            // ->resize(null, 460, function ($constraint) {
            //     $constraint->aspectRatio();
            // })
            // ->save($imageLink);
            \Image::make($coverPhoto->getRealPath())->resize(null, 460, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($imageLink, 70); // quality medium
        }

        $blog->category_id = $request->input('category_id');
        $blog->slug = CustomHelper::generateSlug($request->input('title'), 'blogs');
        $blog->title = $request->input('title');
        $blog->cover_photo = $imageLink;
        $blog->description = $request->input('description');
        $blog->msngr_btn_upper_text = $request->input('msngr_btn_upper_text');
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
        return view('admin.blogs.edit', compact('blog', 'bcategories'));
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
        // saving image in the directory
        $coverPhoto = $request->file('cover_photo');
        $imageLink = '';
        if ($coverPhoto) {
            $path = 'images/uploads/blogs/';
            $fileName = time() . '-' . $coverPhoto->getClientOriginalName();
            $imageLink = $path . $fileName;
            // $img = \Image::make(base64_decode($coverPhotode))
            // ->resize(null, 460, function ($constraint) {
            //     $constraint->aspectRatio();
            // })
            // ->save($imageLink);
            \Image::make($coverPhoto->getRealPath())->resize(null, 460, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($imageLink, 70); // quality medium
        }

        $blog = Blog::findOrFail($id);
        $blog->category_id = $request->input('category_id');
        $blog->slug = ($blog->title == $request->input('title'))
            ? $blog->slug
            : CustomHelper::generateSlug($blog->title, 'blogs');
        $blog->title = $request->input('title');
        if ($coverPhoto) {
            $blog->cover_photo = $imageLink;
        }
        $blog->description = $request->input('description');
        $blog->msngr_btn_upper_text = $request->input('msngr_btn_upper_text');
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
        $fileName = public_path() . '/' . $blog->cover_photo;
        if (file_exists($fileName))  \File::delete($fileName);

        $blog->delete();

        return back()->with('success', 'Deleted');
    }
}
