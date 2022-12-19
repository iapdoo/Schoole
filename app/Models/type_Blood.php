<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_Blood extends Model
{
    use HasFactory;
    protected $table='type__bloods';
    protected $fillable=['Name'];
}
