<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodTest extends Model
{
    protected $table = 'blood_tests';
    protected $fillable = ['name','description'];
}
