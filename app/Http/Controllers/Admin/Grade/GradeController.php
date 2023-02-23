<?php

namespace App\Http\Controllers\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        $grades=Grade::all();

        return view('pages.Grades.Grade',compact('grades'));
    }


    public function store(StoreGrades $request)
    {
//        if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
//            return redirect()->back()->withErrors(['error'=>trans('massage.exists')]);
//        }
        try {

            $Grade=new Grade();
            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            toastr()->success(trans('massage.success'));

            return redirect()->route('Grades.index');

        }catch (\Exception $exception){

            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);
        }
        $Grade=new Grade();
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $Grade->Notes = $request->Notes;
        $Grade->save();
        toastr()->success(trans('massage.success'));

        return redirect()->route('Grades.index');
    }



    public function update(StoreGrades $request, $id)
    {
//        return  dd($request);
        try {
            $grade=Grade::find($id);
            if (!$grade){
                return redirect()->back()->withErrors(['error'=>trans('massage.no')]);
            }
            $grade->update([
                $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $grade->Notes = $request->Notes,
            ]);
            toastr()->success(trans('massage.update'));
            return redirect()->route('Grades.index');

        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);
        }



    }

    public function destroy($id)
    {
        try {
            $grades=Grade::find($id);
            if (!$grades){
                return redirect()->back()->withErrors(['error'=>trans('massage.no')]);
            }
            $ClassRoom = $grades->ClassRoom();
            if (isset($ClassRoom) && $ClassRoom->count() > 0) {
                return redirect()->back()->withErrors(['error'=>trans('massage.noPermation')]);
            }
            $grades->delete();
            toastr()->success(trans('massage.delete'));
            return redirect()->route('Grades.index');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);
        }

    }
}
