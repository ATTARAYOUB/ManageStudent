<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'schedule', 'room', 'teacher_id'];

    // Course belongs to a teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Course has many students through enrollments
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}
