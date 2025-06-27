<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    
    protected $fillable = [
        'class_id',
        'student_id',
        'year',
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
