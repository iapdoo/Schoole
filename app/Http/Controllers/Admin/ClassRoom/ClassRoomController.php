<?php

namespace App\Http\Controllers\Admin\ClassRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRoom;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return dd($request->List_Classes);

//        return dd($request->List_Classes);
//        if (ClassRoom::where('Name_Class->ar', $request->Name_Class)->orWhere('Name_Class->en', $request->Name_Class_en)->exists()) {
//            return redirect()->back()->withErrors(['error' => trans('massage.exists')]);
//        }
        $this->validate($request, [
            'Name_Class' => 'required',
            'Name_Class_en' => 'required',
        ]);
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
        return dd($request->List_Classes);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ClassRoom $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classRoom)
    {
        //
    }
}
