<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karigor\Helpers\CustomHelper;
use App\Models\Vendor;
use App\Models\Bank_type;

class VendorController extends Controller
{
    private $uploadPath = 'images/uploads/vendors/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uplaodPath = $this->uploadPath;
        $vendors = Vendor::get();
        return view('admin.vendor.index', compact('vendors', 'uplaodPath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bankTypes = Bank_type::pluck('name', 'id')->toArray();
        return view('admin.vendor.create', compact('bankTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vendor $vendor)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:vendors|max:255',
            'shop_name' => 'required|unique:vendors|max:255',
            'password' => 'required|max:255',
            'photo' => 'required|mimes:jpg,jpeg,png',
            'brand_banner' => 'required|mimes:jpg,jpeg,png',
            'brand_logo' => 'required|mimes:jpg,jpeg,png',
        ]);
        // saving the images
        if ($request->file('brand_banner')) {
            $brandBanner = CustomHelper::saveImage($request->file('brand_banner'), $this->uploadPath, 600, 600);
            $vendor->brand_banner = $brandBanner;
        }
        if ($request->file('photo')) {
            $photo = CustomHelper::saveImage($request->file('photo'), $this->uploadPath, 300, 300);
            $vendor->photo = $photo;
        }
        if ($request->file('brand_logo')) {
            $brandLogo = CustomHelper::saveImage($request->file('brand_logo'), $this->uploadPath, 50, 50);
            $vendor->brand_logo = $brandLogo;
        }

        // saving vendors personal information   
        $vendor->name = $request->input('name');
        $vendor->email = $request->input('email');
        $vendor->password = bcrypt($request->input('password'));

        $vendor->phone = $request->input('phone');
        $vendor->gender = $request->input('gender');
        $vendor->dob = $request->input('dob');
        // saving vendor's shop related information
        $vendor->shop_name = $request->input('shop_name');
        $vendor->shop_slug = \Str::slug($request->input('shop_name'), '-');


        $vendor->brand_page_link = $request->input('brand_page_link');
        // saving vendor's address related information
        $vendor->street_1 = $request->input('street_1');
        $vendor->street_2 = $request->input('street_2');
        $vendor->zipcode = $request->input('zipcode');
        $vendor->city = $request->input('city');
        $vendor->country = $request->input('country');
        // saving vendor's financial information
        $vendor->banking_type = $request->input('banking_type');
        $vendor->account_name = $request->input('account_name');
        $vendor->account_number = $request->input('account_number');
        $vendor->bank_name = $request->input('bank_name');
        $vendor->branch_name = $request->input('branch_name');
        $vendor->commission_percent = $request->input('commission_percent');
        $vendor->save();

        return redirect(route('vendors.index'))->with('success', 'Saved');
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
        $vendor = Vendor::findOrFail($id);
        $bankTypes = Bank_type::pluck('name', 'id')->toArray();
        return view('admin.vendor.edit', compact('vendor', 'uplaodPath', 'bankTypes'));
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
        $validatedData = $request->validate([
            'email' => 'required|unique:vendors,email,' . $id . ',id|max:255',
            'shop_name' => 'required|unique:vendors,shop_name,' . $id . ',id|max:255',
        ]);
        $vendor = Vendor::findOrFail($id);

        // uploading new files
        if ($request->file('brand_banner')) {
            // delete file
            $fileName = public_path() . '/' . $this->uploadPath . $vendor->brand_banner;
            if (file_exists($fileName)) \File::delete($fileName);
            //uploading new image
            $brandBanner = CustomHelper::saveImage($request->file('brand_banner'), $this->uploadPath, 600, 600);
            $vendor->brand_banner = $brandBanner;
        }
        if ($request->file('photo')) {
            // delete file
            $fileName = public_path() . '/' . $this->uploadPath . $vendor->photo;
            if (file_exists($fileName)) \File::delete($fileName);
            //uploading new image
            $photo = CustomHelper::saveImage($request->file('photo'), $this->uploadPath, 300, 300);
            $vendor->photo = $photo;
        }
        if ($request->file('brand_logo')) {
            // delete file
            $fileName = public_path() . '/' . $this->uploadPath . $vendor->brand_logo;
            if (file_exists($fileName)) \File::delete($fileName);
            //uploading new image
            $brandLogo = CustomHelper::saveImage($request->file('brand_logo'), $this->uploadPath, 50, 50);
            $vendor->brand_logo = $brandLogo;
        }

        // saving vendors personal information   
        $vendor->name = $request->input('name');
        $vendor->email = $request->input('email');
        // checking if new password exist
        if ($request->input('password')) {
            $vendor->password = bcrypt($request->input('password'));
        }
        $vendor->phone = $request->input('phone');
        $vendor->gender = $request->input('gender');
        $vendor->dob = $request->input('dob');

        // saving vendor's shop related information
        $vendor->shop_name = $request->input('shop_name');
        $vendor->shop_slug = \Str::slug($request->input('shop_name'), '-');
        $vendor->brand_page_link = $request->input('brand_page_link');

        // saving vendor's address related information
        $vendor->street_1 = $request->input('street_1');
        $vendor->street_2 = $request->input('street_2');
        $vendor->zipcode = $request->input('zipcode');
        $vendor->city = $request->input('city');
        $vendor->country = $request->input('country');
        // saving vendor's financial information
        $vendor->banking_type = $request->input('banking_type');
        $vendor->account_name = $request->input('account_name');
        $vendor->account_number = $request->input('account_number');
        $vendor->bank_name = $request->input('bank_name');
        $vendor->branch_name = $request->input('branch_name');
        $vendor->commission_percent = $request->input('commission_percent');
        $vendor->save();
        return redirect(route('vendors.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        // delete file
        $fileName = public_path() . '/' . $this->uploadPath . $vendor->brand_banner;
        if (file_exists($fileName)) \File::delete($fileName);
        $fileName = public_path() . '/' . $this->uploadPath . $vendor->brand_logo;
        if (file_exists($fileName)) \File::delete($fileName);
        $fileName = public_path() . '/' . $this->uploadPath . $vendor->photo;
        if (file_exists($fileName)) \File::delete($fileName);

        $vendor->delete();

        return back()->with('success', 'Deleted');
    }
    /**
     * Toogle is_active column of  a vendor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function toggleActivation(Request $request)
    {

        $vendor = Vendor::findOrFail($request->id);
        $vendor->is_active = !$vendor->is_active;
        $is_active = $vendor->is_active;
        $vendor->save();
        return response()->json(['success' => 'is_active changed', 'new_is_active' => $is_active]);
    }

    /**
     * Toogle is_featured column of  a vendor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleFeature(Request $request)
    {

        $vendor = Vendor::findOrFail($request->id);
        $vendor->is_featured = !$vendor->is_featured;
        $is_featured = $vendor->is_featured;
        $vendor->save();
        return response()->json(['success' => 'is_active changed', 'new_is_featured' => $is_featured]);
    }
}
