<?php

namespace App\Repository;
use App\Models\ClassRoom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface  {

//    // Create Student
    public function Create_Student()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add',$data);
    }
    // Get classrooms
    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        return $list_classes;
    }
    // Get Sections
    public function Get_Sections($id)
    {
        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }
    // store student
    public function store_Student($request){
        DB::beginTransaction();
        try {
//            $data = $request->all();
//            $data['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
//            $data['password'] = Hash::make($request->password);
//            Student::create($data);


            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            // insert into images table
            if ($request->hasfile('photos')){
                foreach ($request->file('photos') as $file){
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


}
    // Get Student
    public function Get_Student(){
        $students=Student::all();
        return view('pages.Students.index',compact('students'));
    }
    // Show Student
    public function Show_Student($id) {
        $Student =  Student::findOrFail($id);
//        return dd($Student->images);
          return view('pages.Students.show',compact('Student'));
    }
    // Edit Student
    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        $Students =  Student::findOrFail($id);
        return view('pages.Students.edit',$data,compact('Students'));
    }
    // Update Student
    public function Update_Student($request,$id){
        try {

//            dd($request);
//            $data = $request->except(['_token', '_method']);
//            $data['name'] = ['en' => $request->name_en, 'ar' => $request->name_ar];
//            if ($request->has('password')) {
//                $data['password'] = Hash::make($request->password);
//            }
//            Student::where('id',$id)->update($data);
            $Edit_Students = Student::findorfail($id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password =  Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Delete Student
    public function Delete_Student($id)
    {
        try {
            $student=Student::findOrFail($id);
            $student->delete();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    // Upload attachment
    public function Upload_attachment($request){

        try {
            foreach ($request->file('photos') as $file){
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');
                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $request->student_id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
                toastr()->success(trans('message.success'));
                return redirect()->route('Students.show',$request->student_id);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    // Download attachment
    public function Download_attachment($studensname, $filename){
        return response()->download(public_path('attachments/students/'.$studensname .'/'.$filename));
    }
    // Delete attachment
    public function Delete_attachment($request){
        try {
            // delete image on server
            Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name .'/'.$request->filename);
            // delete image on database
            Image::where('id',$request->id)->where('filename',$request->filename)->delete();
            toastr()->success(trans('message.delete'));
            return redirect()->route('Students.show',$request->student_id);
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
