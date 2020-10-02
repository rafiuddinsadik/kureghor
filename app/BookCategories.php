<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategories extends Model
{
    protected $table = 'book_categories';
    protected $fillable = ['book_id', 'category_id'];
    public $timestamps = false;
}
