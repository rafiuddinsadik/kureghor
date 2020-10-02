<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title', 'slug'];

//    public function books(){
//        return $this->belongsToMany('App\Book', 'book_categories', 'category_id', 'book_id');
//    }
}
