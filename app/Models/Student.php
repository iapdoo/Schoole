<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $table = 'students';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender_id',
        'nationalitie_id',
        'blood_id',
        'Date_Birth',
        'Grade_id',
        'Classroom_id',
        'section_id',
        'academic_year',
    ];

}
