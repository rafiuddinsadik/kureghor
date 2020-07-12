<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();
        $compact = compact('authors');
        return view('admin.authors.index', $compact);
    }

    public function add(Request $request){
        Author::insert([
            'name'=> $request->name,
            'slug'=>$request->slug,
            'created_at' => now()
        ]);

        return redirect()->back();
    }
    public function modify($slug){
        $author = Author::where('slug', $slug)->limit(1)->get();
        $compact = compact('author');
        return view('admin.authors.update', $compact);
    }
    public function update(Request $request, $slug){
        Author::where('slug', $slug)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.authors');
    }

    public function delete($slug){
        Author::where('slug', $slug)->delete();
        return redirect()->route('admin.authors');
    }
}
