<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{

    use HasFactory,HasTranslations;
    public $translatable = ['Name'];

    protected $table='specializations';
    protected $fillable=[
        'Name',
    ];
//    // Specialization has many Teacher
//    public function Teachers()
//    {
//        return $this->hasMany('App\Models\Teacher', 'Specialization_id');
//    }
}
