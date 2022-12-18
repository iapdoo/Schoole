<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClassRoom extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name_Class'];

    protected $table='class_rooms';
    protected $fillable=[
        'Name_Class',
        'Grade_id',
    ];
    public function Grades(){
        return $this->belongsTo('app\Models\Grade','Grade_id','id');
    }
}
