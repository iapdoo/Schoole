<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $Graduated;
    public function __construct(StudentGraduatedRepositoryInterface $Graduated){
        $this->Graduated=$Graduated;
    }
    public function index()
    {
        return $this->Graduated->index();
    }


    public function create()
    {
        return $this->Graduated->create();
    }


    public function store(Request $request)
    {
        return $this->Graduated->softDelete($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->Graduated->returnData($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
