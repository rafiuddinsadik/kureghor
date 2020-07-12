<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $compact = compact('categories');
        return view('admin.categories.index', $compact);
    }

    public function add(Request $request){
        Category::create([
            'title'=> $request->title,
            'slug'=>$request->slug,
        ]);

        return redirect()->back();
    }

    public function modify($slug){
        $category = Category::where('slug', $slug)->limit(1)->get();
        $compact = compact('category');
        return view('admin.categories.update', $compact);
    }
    public function update(Request $request, $slug){
        Category::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.categories');
    }

    public function delete($slug){
        Category::where('slug', $slug)->delete();
        return redirect()->route('admin.categories');
    }


}
