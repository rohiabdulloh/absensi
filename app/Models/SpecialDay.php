<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDay extends Model
{
    protected $fillable = [
        'date',
        'type',
        'description',
    ];

}
