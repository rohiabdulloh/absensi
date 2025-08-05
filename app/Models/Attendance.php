<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
                                    
class Attendance extends Model
{
    
     protected $fillable = [
        'student_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'year',
        'leave_id',
        'msg_sent',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
