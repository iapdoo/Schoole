<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{

    use HasFactory,HasTranslations;
    public $translatable = ['Name'];

    protected $table='grades';
    protected $fillable=[
        'Name',
        'Notes',
    ];
    public function ClassRoom(){
        return $this->hasMany('app\Models\ClassRoom','Grade_id','id');
    }
}
