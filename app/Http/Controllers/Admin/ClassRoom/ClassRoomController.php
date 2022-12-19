<?php

namespace App\Http\Controllers\Admin\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRoom;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{

    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
    }


    public function store(StoreClassRoom $request)
    {
        try {
            $List_Classes = $request->List_Classes;
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new ClassRoom();
                $My_Classes->Name_Class = ['en' => $List_Class['Name_Class_en'], 'ar' => $List_Class['Name_Class']];
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }
            toastr()->success(trans('massage.success'));

            return redirect()->route('Classrooms.index');
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->back()->withErrors(['error' => trans('massage.error')]);
        }
    }



    public function update(StoreClassRoom $request, $classRoom_id)
    {
//        return dd($request);
        try {
            $classRoom = ClassRoom::find($classRoom_id);
            if (!$classRoom) {
                return redirect()->back()->withErrors(['error' => trans('massage.no')]);
            }
            $classRoom->update([
                $classRoom->Name_Class = ['en' => $request->Name_en, 'ar' => $request->Name],
                $classRoom->Grade_id = $request->Grade_id,
            ]);
            toastr()->success(trans('massage.update'));
            return redirect()->route('Classrooms.index');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => trans('massage.error')]);
        }

    }


    public function destroy($classRoom_id)
    {
        try {
            $classRoom = ClassRoom::find($classRoom_id);
            if (!$classRoom) {
                return redirect()->back()->withErrors(['error' => trans('massage.no')]);
            }
            $classRoom->delete();
            toastr()->success(trans('massage.delete'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => trans('massage.error')]);
        }

    }

    public function delete_all(Request $request)
    {

        try {
            $delete_all_id = explode(",", $request->delete_all_id);
//            return dd($delete_all_id);
            ClassRoom::whereIn('id', $delete_all_id)->delete();
            toastr()->success(trans('massage.delete'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => trans('massage.error')]);
        }
    }
    public function Filter_Classes(Request $request){

            $Grades=Grade::all();
            $Search=ClassRoom::select('*')->where('Grade_id',$request->Grade_id)->get();
        return view('pages.My_Classes.My_Classes', compact('Grades'))->withDetails($Search);

    }
}
