<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'price',
        'discount_price',
        'stock',
        'translator_id',
        'country',
        'language',
        'edition',
        'page_count',
        'status',
        'viewer',
        'total_sell',
        'image_path',
        'demo_path',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function categories(){
        return $this->belongsToMany('App\Category', 'book_categories', 'book_id', 'category_id');
    }
    public function authors(){
        return $this->belongsToMany('App\Author', 'book_authors', 'book_id', 'author_id');
    }
    public function translator(){
        return $this->hasOne('App\Translator', 'id', 'translator_id');
    }
    public function publisher(){
        return $this->hasOne('App\Publisher', 'id', 'publisher_id');
    }
}