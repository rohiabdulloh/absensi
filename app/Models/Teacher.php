<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
     protected $fillable = [
        'user_id',
        'nip',
        'name',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'teacher_classes', 'teacher_id', 'class_id')
            ->withPivot('year');
    }
}
