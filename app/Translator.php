<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    protected $table = 'translators';
    protected $fillable = ['name', 'slug', 'description'];
}
