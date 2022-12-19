<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Religiton extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name'];
    protected $table='religitons';
    protected $fillable=['Name'];
}
