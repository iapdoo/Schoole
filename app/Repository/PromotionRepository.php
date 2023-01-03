<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades =Grade::all();
        return view('pages.Students.Promotion.index',compact('Grades'));
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            //     get student information
            $students=Student::where('Grade_id',$request->Grade_id)
                ->where('Classroom_id',$request->Classroom_id)
                ->where('section_id',$request->section_id)
                ->where('academic_year',$request->academic_year)
                ->get();

            if ($students->count()<1)
            {
//                return redirect()->back()->with(['error'=>trans('massage.NoData')]);
                toastr()->error(trans('massage.NoData'));
                return redirect()->route('promotion.index');
            }
//      update in table students
            foreach ($students as $student){
                $ids=explode(',',$student->id);
                 Student::whereIn('id',$ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);
                //     add updated data into promotions table
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('promotion.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $promotions= Promotion::all();
        return view('pages.Students.Promotion.management',compact('promotions'));
    }
    public function destroy($request){

        try {
            DB::beginTransaction();

            if ($request->page_id==1){
                $promotions=Promotion::all();
                foreach ($promotions as $promotion) {
                    $ids = explode(',', $promotion->student_id);
                    Student::whereIn('id', $ids)
                        ->update([
                            'Grade_id' => $promotion->from_grade,
                            'Classroom_id' => $promotion->from_Classroom,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year,
                        ]);
                }
                Promotion::truncate();
                DB::commit();
                toastr()->success(trans('message.delete'));
                return redirect()->route('promotion.index');
            }else{
                $promotion=Promotion::findOrFail($request->id);
                Student::where('id', $promotion->student_id)
                    ->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_Classroom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);
                Promotion::destroy($request->id);
                DB::commit();
                toastr()->success(trans('message.delete'));
                return redirect()->route('promotion.index');
            }



        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}


