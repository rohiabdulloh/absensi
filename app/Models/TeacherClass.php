<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    
    protected $fillable = [
        'class_id',
        'teacher_id',
        'year',
    ];

    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
