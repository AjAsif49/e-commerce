<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;
use Auth;



class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.pages.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:25',
            'brand_image' => 'required|mimes:jpg.jpeg,png',

        ],
        [
            'brand_name.required'=>'Enter Brand name please',
            'brand_image.min' =>'Brand longer than 4 characters',
            
        ]);
        $brand_image = $request->file('brand_image');

        // $name_generate = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_generate.'.'.$img_ext;
        // $upload_location = 'image/brand/';
        // $last_img = $upload_location.$img_name;
        // $brand_image -> move($upload_location, $img_name);

        $name_generate = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)-> resize(300, 200)->save('image/brand'.$name_generate);
        $last_img = 'image/brand'.$name_generate;

        Brand::insert([
            'brand_name'=> $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');

    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.pages.brand.edit', compact('brands'));

    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|max:25',

        ],
        [
            'brand_name.required'=>'Enter Brand name please',
            'brand_image.min' =>'Brand longer than 4 characters',
            
        ]);
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            
            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generate.'.'.$img_ext;
            $upload_location = 'image/brand/';
            $last_img = $upload_location.$img_name;
            $brand_image -> move($upload_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

        // return Redirect()->back()->with('success', 'Brand Updated Successfully');
        return Redirect()->route('all.brand')->with('success', 'Category updated Successfully');

    }

        else{
            Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            // return Redirect()->back()->with('success', 'Brand Updated Successfully');
            return Redirect()->route('all.brand')->with('success', 'Category updated Successfully');

        }

        

    }

    public function delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');

    }


    public function Logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
}
