<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'loan_date', 'due_date', 'return_date', 'protocol', 'fine_amount', 'status'];

    protected $casts = [
        'loan_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
    ];


    // Methd to return the name transla..
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'active':
                return 'Ativo';
            case 'returned':
                return 'Devolvido';
            case 'pending':
                return 'Pendente';
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