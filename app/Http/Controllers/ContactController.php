<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.pages.contact.index', compact('contacts'));
    }

    public function AdminAddContact(){
        return view('admin.pages.contact.create');
    }

    public function AdminStoreContact(Request $request){
        Contact::insert([
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Added Successfully');

    }

    public function EditContact($id){
        $contacts = Contact::find($id);
        return view('admin.pages.contact.edit', compact('contacts'));
    }

    public function UpdateContact(Request $request, $id){
        $update = Contact::find($id)->update([
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');

    }

    public function DeleteContact($id){
        $delete = Contact::find($id)->Delete();
        return Redirect()->back()->with('success', 'Contact Deleted Successfully');

    }

    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact', compact('contacts'));
    }


    public function ContactForm(Request $request){
        ContactForm::insert([
            'name'=> $request->name,
            'email' => $request->email,
            'subjct' => $request->subjct,
            'message' => $request->message,
            'created_at' => Carbon::now()

        ]);
        return Redirect()->route('contact')->with('success', 'Message Sent Successfully');

    }

    public function AdminMessage(){
        $messages = ContactForm::all();
        return view('admin.pages.contact.message', compact('messages'));
    }

    public function DeleteMessage($id){
        ContactForm::find($id)->delete();
        return Redirect()->back()->with('success', 'Message Deleted Successfully');

    }

}
