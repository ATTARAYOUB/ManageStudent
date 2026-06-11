<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'role', 'image', 'user_id'];

    // Administrator belongs to a User account
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
