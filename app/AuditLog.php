<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['user_id', 'action', 'target_type', 'target_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
