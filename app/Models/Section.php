<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
   use HasFactory,HasTranslations;
    public $translatable = ['Name_Section'];

    protected $table='sections';
    protected $fillable=[
        'Name_Section',
        'Status',
        'Grade_id',
        'Class_id',
    ];
    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo('App\Models\ClassRoom', 'Class_id');
    }
}
