<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
    protected $fillable = ['loan_id', 'book_id', 'quantity', 'returned'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
