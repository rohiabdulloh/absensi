<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nis',
        'name',
        'gender',
        'year_entry', 
        'parent_hp',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->hasMany(StudentClass::class);
    }
    
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    
    public function leace()
    {
        return $this->hasMany(Leave::class);
    }
}
