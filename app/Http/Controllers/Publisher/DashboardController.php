<?php

namespace App\Http\Controllers\Publisher;

use App\Book;
use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $getPublisherId = Publisher::where('email', '=', Auth::user()->email)->get()[0]->id;
        $books = Book::where('publisher_id', $getPublisherId)->paginate(10);
        return view('publishers.dashboard.index', compact('books'));
    }
}
