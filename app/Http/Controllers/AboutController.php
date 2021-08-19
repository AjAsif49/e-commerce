<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabouts = HomeAbout::latest()->get();
        return view('admin.pages.home.index', compact('homeabouts'));
    }

    public function AddAbout(){
        return view('admin.pages.home.create');
    }

    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title'=> $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.pages.about')->with('success', 'About Added Successfully');

    }

    public function EditAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.pages.home.edit', compact('homeabout'));
    }

    public function UpdateAbout(Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title'=> $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,        ]);

        return Redirect()->route('home.pages.about')->with('success', 'About Updated Successfully');

    }

    public function DeleteAbout($id){
        $delete = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully');

    }
}