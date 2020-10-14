<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function edit()
    {
        $settings = Setting::all();

        $options = [
            'about_us' => null,
            'term_and_conditions' => null,
            'privacy_policy' => null,
            'faq' => null,
            'fb_pixel_code' => null,
            'fb_messenger_code' => null,
            'google_analytics' => null,
            'messenger_link' => null,
        ];
        foreach($settings as $option){
            $options[$option->name] = $option->content;
        }

        return view('admin.settings', compact('options'));
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function update(Request $request)
    {

        // if($request->ajax()) {
            // dd($request->all());

            foreach($request->all() as $key=>$value){
                if($key == '_token') continue;

                $option = Setting::where('name', $key)->first();
                if($option){
                    $option->content =$value?$value:" ";
                    $option->save();
                }
                else{
                    $obj = new Setting;
                    $obj->name = $key;
                    $obj->content = $value?$value:" ";
                    $obj->save();
                }
            }

            return back()->with('success', 'Saved');
            // return response()->json(
            //     [
            //         'status'=>'success', 
            //         'message'=>'Static pages updated successfully!',
            //     ]
            // ); 
        // }
        // else {
        //     return "Error: Please try again";
        // }
    }
}
