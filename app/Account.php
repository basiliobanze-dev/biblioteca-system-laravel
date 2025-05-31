<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['user_id', 'gender', 'birth_date', 'phone', 'address', 'profile_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
