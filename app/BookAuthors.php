<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAuthors extends Model
{
    protected $table = 'book_authors';
    protected $fillable = ['book_id', 'author_id'];
    public $timestamps = false;
}
