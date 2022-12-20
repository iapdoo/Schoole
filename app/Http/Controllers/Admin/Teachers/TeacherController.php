<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher){
        $this->Teacher=$Teacher;
    }

    public function index()
    {
        $Teachers= $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));

    }


    public function create()
    {
        $specializations =$this->Teacher->getSpecialization();
        $genders  =$this->Teacher->getGender();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }


    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }


    public function edit($teacher_id)
    {
        try {
            $Teachers= $this->Teacher->EditTeachers($teacher_id);
            $specializations = $this->Teacher->getSpecialization();
            $genders  = $this->Teacher->getGender();
            return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);
        }

    }


    public function update(StoreTeachers $request,  $teacher_id)
    {
        return $this->Teacher->UpdateTeachers($request,$teacher_id);
    }


    public function destroy($teacher_id)
    {
        return $this->Teacher->DestroyTeachers($teacher_id);
    }
}
