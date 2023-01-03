<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';
//    protected $fillable = [
//        'student_id',
//        'from_grade',
//        'from_Classroom',
//        'from_section',
//        'to_grade',
//        'to_Classroom',
//        'to_section',
//    ];
    protected $guarded = [];



    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب

    public function f_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_section');
    }


    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function f_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_Classroom');
    }

    // علاقة بين الطلاب الاقسام الدراسية لجلب اسم القسم  في جدول الطلاب

    public function f_section()
    {
        return $this->belongsTo('App\Models\Section', 'from_section');
    }
    public function t_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }


    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function t_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_Classroom');
    }

    // علاقة بين الطلاب الاقسام الدراسية لجلب اسم القسم  في جدول الطلاب

    public function t_section()
    {
        return $this->belongsTo('App\Models\Section', 'to_section');
    }


}
