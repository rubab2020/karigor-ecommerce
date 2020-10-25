<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;

class AttributeOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = AttributeOption::get();
        
        return view('admin.attribute-options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::pluck('name', 'id')->toArray();
        return view('admin.attribute-options.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = new AttributeOption;
        $option->attribute_id = $request->input('attribute_id');
        $option->name = $request->input('name');
        $option->save();

        return redirect(route('attribute-options.index'))->with('success', 'Saved');
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
        $option = AttributeOption::findOrFail($id);

        $attributes = Attribute::pluck('name', 'id')->toArray();

        return view('admin.attribute-options.edit' , compact('option', 'attributes'));
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
        $option = AttributeOption::findOrFail($id);
        $option->name = $request->input('name');
        $option->attribute_id = $request->input('attribute_id');
        $option->save();

        return redirect(route('attribute-options.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = AttributeOption::findOrFail($id);
        $option->delete();

        return back()->with('success', 'Deleted');
    }
}
