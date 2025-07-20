<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'grade',
        'name',
    ];

    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classes', 'student_id', 'class_id')
            ->withPivot('year');
    }

    
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_classes', 'student_id', 'class_id')
            ->withPivot('year');
    }
}
