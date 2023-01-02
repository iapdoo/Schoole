<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';
    protected $fillable = [
        'student_id',
        'from_grade',
        'from_Classroom',
        'from_section',
        'to_grade',
        'to_Classroom',
        'to_section',
    ];

}
