<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'image', 'user_id'];

    // A teacher has many students
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // A teacher belongs to a User account
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A teacher has many courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
