<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSection;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades=Grade::with(['Sections'])->get();
        $list_Grades=Grade::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades'));

    }



    public function store(StoreSection $request)
    {
//        return dd($request);
        try {

            $Sections = new Section();

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('Sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);

        }
    }


    public function update(StoreSection $request, $id)
    {

        try {
            $Sections = Section::find($id);
            if (!$Sections){
                return redirect()->back()->withErrors(['error'=>trans('massage.no')]);
            }
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 0;
            }
            $Sections->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>trans('massage.error')]);
        }
    }

    public function destroy($id)
    {
        try {
            $SECTIONS = Section::find($id);
            if (!$SECTIONS) {
                return redirect()->back()->withErrors(['error' => trans('massage.no')]);
            }
            $SECTIONS->delete();
            toastr()->success(trans('massage.delete'));
            return redirect()->route('Sections.index');
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => trans('massage.error')]);
        }
    }
    public function getclasses($id)
    {
        $list_classes=ClassRoom::where('Grade_id',$id)->pluck("Name_Class","id");
        return $list_classes;
    }
}
