<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }



    public function AllCat(){

        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.pages.category.index', compact('categories', 'trashCat'));
    }


    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required'=>'Enter Category name please',
        ]);
        
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }

    public function edit($id){
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.pages.category.edit', compact('categories'));
    }

    public function update(Request $request, $id){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);


        return Redirect()->route('all.category')->with('success', 'Category updated Successfully');

    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Soft deletion successful');
    }

    public function restore($id){
        $restore = Category::withTrashed($id)->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restored successful');

    }

    public function pdelete($id){
        $restore = Category::onlyTrashed($id)->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category Permanently Deleted');
    }


}
