<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;

interface StudentRepositoryInterface{

//    // Create Student
    public function Create_Student();
   // Get classrooms
    public function Get_classrooms($id);
    // Edit Student
    public function Edit_Student($id);
    // Edit Student
    public function Show_Student($id);
    // Update Student
    public function Update_Student($request,$id);
    // Get Sections
    public function Get_Sections($id);
    // store Student
    public function store_Student($request);
    // Upload attachment
    public function Upload_attachment($request);
    // Download attachment
    public function Download_attachment($studensname, $filename);
    // Delete attachment
    public function Delete_attachment($request);
    // Get Student
     public function Get_Student();
     // Delete Student
     public function Delete_Student($id);
//    // Edit Teachers
//    public function EditTeachers($teacher_id);
//    // Update Teachers
//    public function UpdateTeachers($request,$teacher_id);
//    // Destroy Teachers
//    public function DestroyTeachers($teacher_id);

}
