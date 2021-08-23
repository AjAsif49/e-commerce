<?php

namespace App\Http\Controllers;


use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function ChangePassword(){
        return view('admin.pages.profile.change_password');
    }

    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        
        if(Hash::check($request->oldpassword,$hashedPassword)){    
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Changed Successfully');

        }else{
            return redirect()->back()->with('error', 'Password Is Invalid');

        }
    }

    public function UserProfile(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.pages.profile.update_profile', compact('user'));
            }
        }
    }

    public function ProfileUpdate(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->profile_photo_path = $request['profile_photo_path'];

            $user->save();

           

            return redirect()->back()->with('success', 'profile Updated Successfully');
        }else{
            return redirect()->back();
        }

    }
}

