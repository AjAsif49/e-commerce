<?php

namespace App\Http\Controllers;
use App\Models\multipic;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Image;

class MultiImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function multipic(){
        $images = multipic::all();
        return view('admin.pages.multipic.index', compact('images'));
    }


public function StoreImg(Request $request){
    $image = $request->file('image');

        foreach($image as $multi_img){

        $name_generate = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->save('image/multi/'.$name_generate);
        $last_img = 'image/multi/'.$name_generate;

        multipic::insert([
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        } //end of foreach
        return Redirect()->back()->with('success', 'Image Uploaded Successfully');

}
}