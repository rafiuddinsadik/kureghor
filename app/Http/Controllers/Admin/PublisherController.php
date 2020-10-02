<?php

namespace App\Http\Controllers\Admin;

use App\Publisher;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PublisherController extends Controller
{
    public function index(){
        $publishers = Publisher::where('is_active', 1)->get();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function add(Request $request){
        if(Publisher::where('email', '=', $request->email)->exists() || Publisher::where('slug', '=', $request->slug)->exists()){
            return redirect()->back()->with('error', 'Restricted Duplicate Email or Slug!');
        }
        Publisher::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'is_active' => 1
        ]);
        User::create([
            'name' => $request->title,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => 3
        ]);

        return redirect()->route('admin.publishers');
    }
}
