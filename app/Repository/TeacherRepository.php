<?php

namespace App\Repository;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers(){
        return Teacher::all();
    }


    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getGender()
    {
        return Gender::all();
    }

    public function StoreTeachers($request)
    {
        try {
        $Teachers = new Teacher();
        $Teachers->Email = $request->Email;
        $Teachers->Password =  Hash::make($request->Password);
        $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $Teachers->Specialization_id = $request->Specialization_id;
        $Teachers->Gender_id = $request->Gender_id;
        $Teachers->Joining_Date = $request->Joining_Date;
        $Teachers->Address = $request->Address;
        $Teachers->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Teachers.index');
    }
        catch (Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    }

    public function EditTeachers($teacher_id)
    {
        return Teacher::findOrFail($teacher_id);
    }

    public function UpdateTeachers($request ,$teacher_id)
    {
        try {
            $Teachers = Teacher::findOrFail($teacher_id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function DestroyTeachers($teacher_id)
    {
        Teacher::findOrFail($teacher_id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('Teachers.index');
    }
}
