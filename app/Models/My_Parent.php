<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];

    protected $table='my__parents';
    protected $guarded=[];
//    protected $fillable=[
//        'Email'
//        ,'Password'
//        //Father information
//        ,'Name_Father'
//        ,'National_ID_Father'
//        ,'Passport_ID_Father'
//        ,'Phone_Father'
//        ,'Job_Father'
//        ,'Nationality_Father_id'
//        ,'Blood_Type_Father_id'
//        ,'Religion_Father_id'
//        ,'Address_Father'
//        //Mother information
//        ,'Name_Mother'
//        ,'National_ID_Mother'
//        ,'Passport_ID_Mother'
//        ,'Phone_Mother'
//        ,'Job_Mother'
//        ,'Nationality_Mother_id'
//        ,'Blood_Type_Mother_id'
//        ,'Religion_Mother_id'
//        ,'Address_Mother'
//    ];

}
