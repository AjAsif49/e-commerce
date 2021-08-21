<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider(){
    $sliders = Slider::latest()->get();
    return view('admin.pages.slider.index', compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.pages.slider.create');
    }

    public function StoreSlider(Request $request){
        $slider_image = $request->file('image');

        $name_generate = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)-> resize(1920, 1088)->save('image/slider/'.$name_generate);
        $last_img = 'image/slider/'.$name_generate;

        Slider::insert([
            'title'=> $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');

    }


    public function EditSlider($id){
        $Sliders = Slider::find($id);
        return view('admin.pages.slider.edit', compact('Sliders'));

    }
    

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'title' => 'required|max:25',

        ],
        [
            'title.required'=>'Enter Brand name please',
            'image.min' =>'Brand longer than 4 characters',
            
        ]);
        $old_image = $request->old_image;

        $image = $request->file('image');

        if($image){
            
            $name_generate = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_generate.'.'.$img_ext;
            $upload_location = 'image/slider/';
            $last_img = $upload_location.$img_name;
            $image -> move($upload_location, $img_name);

            unlink($old_image);
            Slider::find($id)->update([
                'title'=> $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);

        return Redirect()->route('home.slider')->with('success', 'Slider updated Successfully');

    }

        else{
            Slider::find($id)->update([
                'title'=> $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->route('home.slider')->with('success', 'Slider updated Successfully');

        }
    }  

    public function delete($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted Successfully');

    }

}