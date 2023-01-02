<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student){
        $this->Student=$Student;
    }
    public function index()
    {
        return $this->Student->Get_Student();
    }


    public function create()
    {
       return $this->Student->Create_Student();
    }

    public function store(StudentRequest $request)
    {
        return $this->Student-> store_Student($request);
    }


    public function edit($id)
    {
        return $this->Student-> Edit_Student($id);
    }


    public function update(StudentRequest $request ,$id)
    {
        return $this->Student->Update_Student($request,$id);
    }
     public function show($id){
         return $this->Student-> Show_Student($id);
     }
    public function destroy($id)
    {
        return $this->Student->Delete_Student($id);
    }
    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }
    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }
    public function Upload_attachment( Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }
    public function Download_attachment( $studensname, $filename)
    {
        return $this->Student->Download_attachment($studensname, $filename);
    }
    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }
}
