<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function getAllTeachers();
    // get all Specialization
    public function getSpecialization();
    // get all Specialization
    public function getGender();
    // Store Teachers
    public function StoreTeachers($request);
    // Edit Teachers
    public function EditTeachers($teacher_id);
    // Update Teachers
    public function UpdateTeachers($request,$teacher_id);
    // Destroy Teachers
    public function DestroyTeachers($teacher_id);

}
