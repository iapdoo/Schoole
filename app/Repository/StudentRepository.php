<?php

namespace App\Repository;
use App\Models\ClassRoom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Models\type_Blood;
use Exception;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface  {


    public function Create_Student()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add',$data);
    }

    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }
}
