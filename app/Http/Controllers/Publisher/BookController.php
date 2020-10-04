<?php

namespace App\Http\Controllers\Publisher;

use App\Author;
use App\Book;
use App\BookAuthors;
use App\BookCategories;
use App\Category;
use App\Publisher;
use App\Translator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function create(){
        $categories = Category::all();
        $authors = Author::all();
        $translators = Translator::all();
        $publishers = Publisher::all();
        return view('publishers.books.create', compact('categories', 'authors', 'translators', 'publishers'));
    }

    public function add(Request $request){
        if(Book::where('slug', Str::slug($request->title, '-'))->get()->count() != 0){
            return redirect()->back();
        }
        $imagePath = null;
        $demoPath = null;
        if($request->file('image') != null){
            $imagePath = $request->file('image')->store('bookCovers', 'public');
        }
        if($request->file('demoContent') != null){
            $demoPath = $request->file('demoContent')->store('demoBooks', 'public');
        }
        $book = new Book();
        $book->title = $request->title;
        $book->sub_title = $request->subTitle;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->discount_price = $request->discountedPrice;
        $book->stock = $request->stock;
        $book->translator_id = $request->translator;
        $book->publisher_id = $request->publisher;
        $book->country = $request->country;
        $book->language = $request->language;
        $book->edition = $request->edition;
        $book->page_count = $request->numberOfPages;
        $book->status = 2;
        $book->slug = Str::slug($request->title, '-');
        $book->image_path = $imagePath;
        $book->demo_path = $demoPath;
        $book->save();

        foreach ($request->authors as $author){
            BookAuthors::create([
                'book_id'=>$book->id,
                'author_id'=>$author
            ]);
        }
        foreach ($request->categories as $category){
            BookCategories::create([
                'book_id'=>$book->id,
                'category_id'=>$category
            ]);
        }
        return redirect()->route('publisher.index')->with('success', 'Book Created Successfully!');
    }

    public function delete($id){
        Book::where('id', $id)->delete();
        BookCategories::where('book_id', $id)->delete();
        BookAuthors::where('book_id', $id)->delete();
        return redirect()->route('publisher.index');
    }
}
