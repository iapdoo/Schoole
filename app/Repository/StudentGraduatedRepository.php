<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades =Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }

    public function softDelete($request)
    {
        $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
        if ($students->count()<1)
        {
//                return redirect()->back()->with(['error'=>trans('massage.NoData')]);
            toastr()->error(trans('massage.NoData'));
            return redirect()->route('Graduated.index');
        }
        foreach ($students as $student){
            $ids=explode(',',$student->id);
            Student::whereIn('id',$ids)->delete();
        }
        toastr()->error(trans('massage.NoData'));
        return redirect()->route('Graduated.index');
    }
    public function returnData($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        toastr()->error(trans('massage.success'));
        return redirect()->back();
    }
}
