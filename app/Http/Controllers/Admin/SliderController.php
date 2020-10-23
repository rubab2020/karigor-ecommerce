<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Karigor\Helpers\CustomHelper;

class SliderController extends Controller
{
    private $uploadPath = 'uploads/sliders/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uplaodPath = $this->uploadPath;
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders', 'uplaodPath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Slider $slider)
    {

        $imageBgName = CustomHelper::saveImage($request->file('image'), $this->uploadPath, 600, 600);
        $imageSmName = CustomHelper::saveImage($request->file('image'), $this->uploadPath, 300, 300);
        $slider->link = $request->input('link');
        $slider->image_bg = $imageBgName;
        $slider->image_sm = $imageSmName;
        $slider->save();
        return redirect(route('sliders.index'))->with('success', 'Saved');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
