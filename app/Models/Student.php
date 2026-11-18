<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['course_id', 'student_no', 'first_name', 'last_name', 'email'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }
}