<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['title', 'slug', 'email', 'phone', 'password', 'is_active'];
}
