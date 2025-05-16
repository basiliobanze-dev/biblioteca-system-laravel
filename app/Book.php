<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'publisher', 'description', 'year', 'isbn', 'quantity_total', 'quantity_available', 'status'];
}
