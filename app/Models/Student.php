<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
      // ATTAR AYOUB NOTES : Why $fillable? It protects against mass assignment
    // It tells Laravel which fields are allowed to be filled via a form. 
    // Without it, Student::create() will throw an error.
    protected $fillable = ['name', 'email', 'phone', 'section', 'image', 'teacher_id'];

      // A student belongs to one teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }




}
