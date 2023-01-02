<?php

namespace App\Repository;

use App\Models\Grade;

class PromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades =Grade::all();
        return view('pages.Students.Promotion.index',compact('Grades'));
    }

    public function store($request)
    {

    }
}
