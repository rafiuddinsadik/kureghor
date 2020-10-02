<?php

namespace App\Http\Controllers\Admin;

use App\Translator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslatorController extends Controller
{
    public function index(){
        $translators = Translator::all();
        $compact = compact('translators');
        return view('admin.translators.index', $compact);
    }

    public function add(Request $request){
        Translator::create([
            'name'=> $request->name,
            'slug'=>$request->slug,
            'description' => $request->description
        ]);

        return redirect()->back();
    }
    public function modify($slug){
        $translators = Translator::where('slug', $slug)->limit(1)->get();
        $compact = compact('translators');
        return view('admin.translators.update', $compact);
    }
    public function update(Request $request, $slug){
        Translator::where('slug', $slug)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.translators');
    }

    public function delete($slug){
        Translator::where('slug', $slug)->delete();
        return redirect()->route('admin.translators');
    }
}
