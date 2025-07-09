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
        return $this->hasMany(StudentClass::class, 'class_id');
    }
}
