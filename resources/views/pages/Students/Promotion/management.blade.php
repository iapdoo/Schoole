@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('admin.list_students')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('admin.list_students')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    {{trans('Students_trans.Delete_all')}}
                                </button>
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th CLASS="alert-info">#</th>
                                            <th CLASS="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th CLASS="alert-danger">{{trans('Students_trans.f_grade')}}</th>
                                            <th CLASS="alert-danger">{{trans('Students_trans.f_classroom')}}</th>
                                            <th CLASS="alert-danger">{{trans('Students_trans.f_section')}}</th>
                                            <th CLASS="alert-danger">{{trans('Students_trans.academic_year')}}</th>
                                            <th CLASS="alert-success">{{trans('Students_trans.t_grade')}}</th>
                                            <th CLASS="alert-success">{{trans('Students_trans.t_classroom')}}</th>
                                            <th CLASS="alert-success">{{trans('Students_trans.t_section')}}</th>
                                            <th CLASS="alert-success">{{trans('Students_trans.academic_year_new')}}</th>

                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->students->name}}</td>
                                                <td>{{$promotion->f_grade->Name}} </td>
                                                <td>{{$promotion->f_classroom->Name_Class}} </td>
                                                <td>{{$promotion->f_section->Name_Section}} </td>
                                                <td>{{$promotion->academic_year}} </td>
                                                <td>{{$promotion->t_grade->Name}} </td>
                                                <td>{{$promotion->t_classroom->Name_Class}} </td>
                                                <td>{{$promotion->t_section->Name_Section}} </td>
                                                <td>{{$promotion->academic_year_new}} </td>

                                                <td>

                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{trans('Students_trans.reterive_student')}}</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{trans('Students_trans.graduate_student')}}</button>

                                                </td>
                                            </tr>
                                        @include('pages.Students.Promotion.Delete_all')
                                        @include('pages.Students.Promotion.Delete_one')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
