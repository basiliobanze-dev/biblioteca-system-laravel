<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'protocol', 'loan_date', 'due_date', 'returned_at', 'status','fine_amount'];

    // Methd to return the name transla..
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'borrowed':
                return 'Emprestado';
            case 'returned':
                return 'Devolvido';
            case 'late':
                return 'Atrasado';
            default:
                return ucfirst($this->status);
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(LoanItem::class);
    }
}
