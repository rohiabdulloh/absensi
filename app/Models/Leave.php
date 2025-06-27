<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'student_id',
        'date',
        'date_start',
        'date_end',
        'type',
        'description',
        'approved',
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
