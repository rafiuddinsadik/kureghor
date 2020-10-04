<?php

namespace App\Http\Controllers\Admin;

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
use PhpParser\Node\Expr\Array_;

class BookController extends Controller
{
    public function index(){
        $books = Book::where('status', 1)->paginate(30);
        $book_pending_count = Book::where('status', 2)->count();
        return view('admin.books.index', compact('books', 'book_pending_count'));
    }

    public function pending(){
        $books = Book::where('status', 2)->paginate(30);
        return view('admin.books.pending', compact('books'));
    }

    public function create(){
        $categories = Category::all();
        $authors = Author::all();
        $translators = Translator::all();
        $publishers = Publisher::all();
        return view('admin.books.create', compact('categories', 'authors', 'translators', 'publishers'));
    }

    public function add(Request $request){
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
        $book->status = 1;
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
        return redirect()->route('admin.book.list')->with('success', 'Book Created Successfully!');
    }

    public function modify($slug){
        $book = Book::where('slug', $slug)->limit(1)->get();
        $categories = Category::all();
        $authors = Author::all();
        $translators = Translator::all();
        $publishers = Publisher::all();
        $authorID = [];
        foreach($book[0]->authors as $author){
            array_push($authorID, $author->id);
        }
        $categoriesID = [];
        foreach($book[0]->categories as $category){
            array_push($categoriesID, $category->id);
        }
        $compact = compact('book', 'categories', 'authors', 'translators', 'authorID', 'categoriesID', 'publishers');
        return view('admin.books.update', $compact);
    }

    public function update($slug, Request $request){
        $book = Book::where('slug', $slug)->limit(1)->get();
        $bookID = $book[0]->id;
        $imagePath = $book[0]->image_path;
        $demoPath = $book[0]->demo_path;
        if($request->file('image') != null){
            Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('bookCovers', 'public');
        }
        if($request->file('demoContent') != null){
            Storage::disk('public')->delete($demoPath);
            $demoPath = $request->file('demoContent')->store('demoBooks', 'public');
        }
        Book::where('slug', $slug)->update([
            'title' => $request->title,
            'sub_title' => $request->subTitle,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discountedPrice,
            'stock' => $request->stock,
            'translator_id' => $request->translator,
            'publisher_id' => $request->publisher,
            'country' => $request->country,
            'language' => $request->language,
            'edition' => $request->edition,
            'page_count' => $request->numberOfPages,
            'image_path' => $imagePath,
            'demo_path' => $demoPath,
            'updated_at' => now()
        ]);

        BookAuthors::where('book_id', $bookID)->delete();
        BookCategories::where('book_id', $bookID)->delete();

        if($request->categories != null) {
            foreach ($request->authors as $author) {
                BookAuthors::create([
                    'book_id' => $bookID,
                    'author_id' => $author
                ]);
            }
        }
        if($request->categories != null){
            foreach ($request->categories as $category){
                BookCategories::create([
                    'book_id'=>$bookID,
                    'category_id'=>$category
                ]);
            }
        }

        return redirect()->route('admin.book.list');
    }

    public function delete($id){
        Book::where('id', $id)->delete();
        BookCategories::where('book_id', $id)->delete();
        BookAuthors::where('book_id', $id)->delete();
        return redirect()->route('admin.book.list');
    }

    public function switch($id){
        $book = Book::where('id', $id)->get()[0];
        if($book->status == 2){
            $book->update([
                'status' => 1
            ]);
        }else{
            $book->update([
                'status' => 2
            ]);
        }
        return redirect()->route('admin.book.list');
    }

}
